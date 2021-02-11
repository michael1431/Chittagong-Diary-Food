<?php

namespace App\Http\Controllers\Inventory;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Sale;
use App\GoodsinProduct;
use App\Product;
use App\Employee;
use App\Invoice;
use App\SaleReturn;
use App\SubDistributor;
use DB;
use App\Inventory\TempData;
use Illuminate\Support\Facades\Auth;

class SalesControler extends Controller
{
    public function storeOrder(Request $request){
        $amount=0;
        //dd($request->customer);
        $inv_serial =  Auth::user()->id.'-'.time();
        $invoice_no= $inv_serial;
        $products = TempData::where([['type',5],['user_id',Auth::user()->id]])->get();

        foreach ($products as $product){
            $save['price']=$product->price;
            $save['qty']=$product->qty;
            $save['note']=$product->note;
            $save['product_id']=$product->product_id;
            $save['order_by'] = $request->customer ?? Auth::user()->id;
            $save['invoice_no'] = $invoice_no;

            $amount+=($product->price*$product->qty);
            Sale::create($save);
            TempData::find($product->id)->delete();
        }

        $invoice=new Invoice;
        $invoice->invoice_no =$invoice_no;
        $invoice->related_party_id = $request->customer ?? Auth::user()->id;
        $invoice->related_party_type = 'Customer';
        $invoice->total_amount = $amount;
        $invoice->status = 0; //0 means pending
        $invoice->event ='sales'; //0 means pending
        $invoice->save();
        
        if($request->customer && $request->name){
            $subDistributor=new SubDistributor;
            $subDistributor->user_id=$request->customer;
            $subDistributor->invoice_no=$invoice_no;
            $subDistributor->name=$request->name;
            $subDistributor->phone=$request->phone;
            $subDistributor->address=$request->address;
            $subDistributor->save();
        }

        echo json_encode(['success'=>1]);

    }

    public function showOrder(Request $request)
    {
        if($request->custom_order==1){
            $customers=Employee::all();
            $products=Product::where('department_id',1)->get();
            return view('inventory.sales_order.custom-order', compact('products','customers'));

        }elseif($request->order_history==1){
            
            $invoices = Invoice::where([['event','sales'],['status',1]])->paginate(15); // 0 means pending 
        }else{
            $invoices = Invoice::where([['event','sales'],['status',0]])->paginate(15); // 0 means pending 
        }
        
        return view('inventory.sales_order.pending-order',compact('invoices'));
    }
    public function returnInvoice($id)
    {
        $invoice = Invoice::find($id);
        $sales_details=Sale::whereInvoiceNo($invoice->invoice_no)->with('product','product.stocks')->get();
        return view('inventory.sales_order.return_invoice',compact('sales_details','invoice'));
    }
    public function showInvoice($id)
    {
        $invoice = Invoice::find($id); // 0 means pending 
        $sales_details=Sale::whereInvoiceNo($invoice->invoice_no)->with('product','product.stocks')->get();
        return view('inventory.sales_order.order_details',compact('sales_details','invoice'));
    }
    public function store(Request $request)
    {
        //return $request->all();
        $emp_commission=$request->emp_commission;
        $mar_commission=$request->mar_commission;
        $qty=$request->qty;
        //dd($mar_commission);
        $commission=0;
        $amount=0;
        $invoice = Invoice::find($request->invoice_id); // 0 means pending 
        $sales_details=Sale::whereInvoiceNo($invoice->invoice_no)->get();

        foreach($sales_details as $sale){

            $sale_update=Sale::find($sale->id);
            $sale_update->order_processed_by=Auth::user()->id;
            $sale_update->qty=$qty[$sale->id];
            $sale_update->emp_commission=$emp_commission[$sale->id];
            $sale_update->mar_commission=$mar_commission[$sale->id];
            $commission+=(($qty[$sale->id] * $emp_commission[$sale->id]) + ($qty[$sale->id] * $mar_commission[$sale->id]));
            $amount+=($sale->price * $qty[$sale->id]);

            //stock
            $goodsinProducts=GoodsinProduct::where([['invoice_no',$sale->invoice_no],['product_id',$sale->product_id],['price',$sale->price]])->first();
            if($goodsinProducts){
                $goodsinProducts->stock_out_qty=$qty[$sale->id];
                $goodsinProducts->update();
            }else{
                $goodsinProducts=new GoodsinProduct;
                $goodsinProducts->invoice_no=$sale->invoice_no;
                $goodsinProducts->product_id=$sale->product_id;
                $goodsinProducts->stock_out_qty=$qty[$sale->id];
                $goodsinProducts->price=$sale->price;
                $goodsinProducts->user_id=Auth::user()->id;
                $goodsinProducts->save();
            }
            //stock
            
            $sale_update->update();
        }

        $invoice->user_id=Auth::user()->id;
        $invoice->total_amount=$amount;
        $invoice->total_discount=$commission;
        $invoice->payment_type=3; //cash  //bank //due
        $invoice->note=$request->note;
        $invoice->status=1; //order
        $invoice->update();

      return redirect()->route('invoice.print',$invoice->id);
    }
    public function returnStore(Request $request)
    {
        try {
            // Begin database transaction
            DB::beginTransaction();

            $qty=$request->qty;
            $commission=0;
            $amount=0;
            $invoice = Invoice::find($request->invoice_id); // 0 means pending 
            $sales_details=Sale::whereInvoiceNo($invoice->invoice_no)->get();

            foreach($sales_details as $sale){
                if($qty[$sale->id] > 0){
                    $sales_return=new SaleReturn;
                    // $sales_return=Sale::find($sale->id);
                    $sales_return->user_id=Auth::user()->id;
                    $sales_return->invoice_id=$invoice->id;
                    $sales_return->product_id=$sale->product_id;
                    $sales_return->sale_id=$sale->id;
                    $sales_return->return_qty=$qty[$sale->id];
                    $sales_return->amount=$sale->price;
                    $sales_return->emp_commission=$sale->emp_commission;
                    $sales_return->mar_commission=$sale->mar_commission;
                    $sales_return->status=1;
                    $commission+=(($qty[$sale->id] * $sale->emp_commission) + ($qty[$sale->id] * $sale->mar_commission));
                    $amount+=($sale->price * $qty[$sale->id]);

                    //stock
                    $goodsinProducts=GoodsinProduct::where([['invoice_no',$sale->invoice_no],['product_id',$sale->product_id],['price',$sale->price],['remarks','sales_return']])->first();
                    if($goodsinProducts){
                        $goodsinProducts->qty=$goodsinProducts->qty+$qty[$sale->id];
                        $goodsinProducts->update();
                    }else{
                        $goodsinProducts=new GoodsinProduct;
                        $goodsinProducts->invoice_no=$sale->invoice_no;
                        $goodsinProducts->product_id=$sale->product_id;
                        $goodsinProducts->qty=$qty[$sale->id];
                        $goodsinProducts->price=$sale->price;
                        $goodsinProducts->remarks='sales_return';
                        $goodsinProducts->user_id=Auth::user()->id;
                        $goodsinProducts->save();
                    }
                    //stock
                    
                    $sales_return->save();
                }
            }
            
            $invoice->total_less=($amount-$commission);
            $invoice->status=1; //order
            $invoice->update();
            DB::commit();
        } catch (\Exception $ex) {
            // Rollback transactions if any errors occured
            DB::rollBack();
            return redirect()->back()->withInput()->with('failed', $ex->getMessage());
        }
      return redirect()->route('invoice.print',$invoice->id);
    }
}
