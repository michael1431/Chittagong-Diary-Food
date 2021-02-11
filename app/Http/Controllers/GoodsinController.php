<?php

namespace App\Http\Controllers;

use App\Cost;
use App\Goodsin;
use App\GoodsinProduct;
use App\Purchase;
use App\Product;
use App\QuotationProduct;
use App\Requisition;
use App\RequisitionProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\CostGoodsin;
use App\AccessoriesStock;
use App\Invoice;
use DB;
class GoodsinController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $goodsin = Goodsin::all();

        $purchases = Purchase::pluck('invoice_no','id');

        return view('inventory.goodsin.add-goodsin',compact('purchases'));
    }

    public function store(Request $request){

        try {
            // Begin database transaction
            DB::beginTransaction();

            $request['user_id'] = Auth::id();
            $purchase = Purchase::find($request->purchase_id);
            $request['requisition_id'] = $purchase->requisition_id;
            $request['quotation_id'] = $purchase->quotation_id;
            //dd($request->all());
            $goodsin = Goodsin::create($request->all());

            /*Goods In Product Save start */

            foreach ($request->qty as $key=>$info){

                $remarks =  $request->remarks[$key];

                $pid = $request->product_id[$key];
                $data['product_id']= $pid;
                $data['qty']= $info;
                $data['remarks']= $remarks !=null ? $remarks : "N/A";

                //dd($data['remarks']);

                $data['goodsin_id']= $goodsin->id;
                $data['requisition_id']= $purchase->requisition_id;
                $data['purchase_id']= $purchase->id;

                $data['user_id']= Auth::id();
                $data['supplier_id']= $purchase->quotation->supplier_id;
                $data['quotation_id']= $purchase->quotation_id;

                $price = QuotationProduct::where('requisition_id',$purchase->requisition_id)
                    ->where('quotation_id',$purchase->quotation_id)
                    ->where('requisition_product_id',$request->requisition_product_id[$key]) //requisition_product_id
                    ->first();

                $data['price'] = $price->price;
                GoodsinProduct::create($data);
            }
            DB::commit();
        } catch (\Exception $ex) {
            // Rollback transactions if any errors occured
            DB::rollBack();
            return redirect()->back()->withInput()->with('failed', $ex->getMessage());
        }
        /*Goods In Product Save End */

        session()->flash('success','Goods in Created successfully');
        return redirect()->route('goodsin.add');
    }

    public function lcCost(){
        $lcs = Invoice::distinct('lc_no')->pluck('lc_no','lc_no');
        //dd($lcs);
        $giftProducts=Product::pluck('name','id');
        // $users=User::where('role_id','!=',1)->get();
        //dd($giftProducts);
        $costs = Cost::pluck('name','id');
        //$lccosts = CostGoodsin::all();
        return view('inventory.goodsin.lc-cost',compact('lcs','costs','giftProducts'));
    }

    public function storeLcCost(Request $request)
    {
        // dd($request->lc_cost_date);
        // return ($request->all());
        try {
            // Begin database transaction
            DB::beginTransaction();
            $this->validate($request,[
                'cost_id'=>'required',
                'expense_type'=>'required',
                'amount'=>'required'
            ]);

            $inv_serial = Auth::user()->id.'-'.time();;
            $invoice_no = $inv_serial;
            if($request->expense_type==2){
                $this->validate($request,[
                    'product'=>'required',
                    'qty'=>'required',
                    'price'=>'required'
                ]);
                $amount=($request->qty*$request->price);
                $event='purchase gift';
                $party= 1;
                
                $data=[
                    'invoice_no'=>$invoice_no,
                    'product_id'=>$request->product,
                    'stock_in_qty'=>$request->qty,
                    'price'=>$request->price,
                    'user_id'=> Auth::user()->id,
                    'created_at'=>$request->lc_cost_date,
                    ];
                    
                    AccessoriesStock::insert($data);

                // $stock=new AccessoriesStock;
                // $stock->invoice_no=$invoice_no;
                // $stock->product_id=$request->product;
                // $stock->stock_in_qty=$request->qty;
                // $stock->price=$request->price;
                // $stock->user_id= Auth::user()->id;
                // $stock->save();
            }else{
                $amount=$request->amount;
                $event='expense';
                $party= $request->cost_id;
            }
            
            $invoiceData=[
                'invoice_no'=>$invoice_no,
                'lc_no'=>$request->lc_no,
                'cost_id'=>$party,
                'total_amount'=>$amount,
                'total_paid'=>$amount,
                'status'=>1,
                'event'=>$event,
                'note'=>$request->note,
                'user_id'=>Auth::user()->id,
                'payment_type'=>1,
                'created_at'=>$request->lc_cost_date,
                'updated_at'=>$request->lc_cost_date,
            ];
            
            Invoice::insert($invoiceData);

            // $invoice=new Invoice;
            // $invoice->invoice_no =$invoice_no;
            // $invoice->lc_no=$request->lc_no;
            // $invoice->cost_id=$party;
            // $invoice->total_amount = $amount;
            // $invoice->total_paid = $amount;
            // $invoice->status = 1; //0 means pending
            // $invoice->event =$event; //
            // $invoice->note =$request->note; //
            // $invoice->user_id=Auth::user()->id;
            // $invoice->payment_type=1; //cash  //bank //due
            // $invoice->save();

            DB::commit();
        } catch (\Exception $ex) {
            // Rollback transactions if any errors occured
            DB::rollBack();
            return redirect()->back()->withInput()->with('failed', $ex->getMessage());
        }
        //AccessoriesStock::create($request->all());
        session()->flash('success','Successfully Complete');
        return redirect()->back();
    }


    /* LC Report start */
    public function lcReport(Request $request){
        $lcs = Invoice::distinct('lc_no')->pluck('lc_no','lc_no');
        //$lcs = Goodsin::pluck('lc','id');
        $invoices = '';
        $lc_no = '';
        if(!empty($request->lc_no)){
            $lc_no = $request->lc_no;
            $invoices = Invoice::where('lc_no',$request->lc_no)->get();
        }
        return view('inventory.report.lc-report',compact('lcs','invoices','lc_no'));
    }
    /* LC Report End */



    /* Individual LC Report Findout Start */
    public function lcReportFind(Request $request){
        if($request->invoice_edit){
            //dd($request->invoice_id);
            $invoiceUpdates=Invoice::whereIn('id',$request->invoice_id)->get();
            foreach($invoiceUpdates as $inv_up){
                $inv_up->created_at=$request->created_at;
                $inv_up->update();
            }
            //dd($invoiceUpdate);
            session()->flash('success','Successfully Complete');
        return redirect()->back();
        }
        //$id = $request->lc_no;
        $invoices = Invoice::where('lc_no',$request->lc_no)->get();
        //dd($request->all());
        return view('inventory.report.lc-report-find',compact('invoices'));
        // $sl=0;
        // $data=[];
        // $return_data="";
        // $total=0;
        // foreach ($invoices as $key=>$info){
        //     $return_data.="<tr>";
        //     $return_data.="<td class='text-center'>". ++$sl ."</td>";
        //     $return_data.="<td class='text-center'>".$info->lc_no."</td>";
        //     $return_data.="<td class='text-left'>".($info->cost ? $info->cost->name:'purchase')."</td>";
        //     $return_data.="<td class='text-right'>".number_format($info->total_amount,2)."</td>";
        //     $return_data.="<td class='text-center'>".$info->created_at->diffForHumans()."</td></tr>";
        //     $total+=$info->total_amount;
            
        //     // $data['sl'][$key] = ++$sl;
        //     // $data['lc'][$key] = $info->lc_no;
        //     // $data['cost'][$key] = $info->cost ? $info->cost->name:'purchase';
        //     // $data['amount'][$key] = number_format($info->total_amount,2);
        //     // $data['time'][$key] = $info->created_at->diffForHumans();
        // }
        // $return_data.="<tr><th colspan='3' class='text-right'>Total Cost</th><th class='text-right'>".number_format($invoices->sum('total_amount'),2)."</th><th></th></tr>";
        // return $return_data;
        //return json_encode(['success'=>$data]);
    }

    /* Individual LC Report Findout End*/


    public function editLC($id){

        $costs = Cost::all();


        $edit = Invoice::find($id);

        return view('inventory.report.lc-report-edit',compact('edit','costs'));

    }

    public function updateLC(Request $request,$id){

      

        $this->validate($request,[

            'lc_no' =>'required',
            'total_amount'=>'required',
            
        ],
        [

            'lc_no.required'=>'Please Enter LC NO',
            'total_amount.required'=>'Please Enter a total amount',
        ]);

       $invoice=new Invoice;

       $invoice->lc_no = $request->lc_no;
       $invoice->cost_id = $request->cost_id;
       $invoice->total_amount = $request->total_amount;

       $invoice->save();

       session()->flash('success','Your data Updated successfully!');

       return redirect('lc-report');
    }

    //Delete LC
    function deleteLC($id){
        $invoice = Invoice::find($id);
        $delete = $invoice->delete();
        // return back();
        if($delete){
            return response(['success'=>true]);
        }
        return response(['success'=>false]);

    }

    public function findQuotationProducts(Request $request){

        $purchase = Purchase::find($request->purchase_id);
        $products = QuotationProduct::where('requisition_id','=',$purchase->requisition_id)->whereQuotationId($purchase->quotation_id)->get();
        
        $sl =0;
        $html ='';

        if($products->count()>0){
            foreach ($products as $key=>$info){
                //$qty = RequisitionProduct::where('requisition_id',$info->requisition_id)->where('product_id',$info->requisition_product_id)->first();
                $qty = RequisitionProduct::find($info->requisition_product_id);
                $quantity=$qty ? $qty->qty :0;
                $received_qty = GoodsinProduct::where('purchase_id',$purchase->id)->where('product_id',$info->requisitionProduct->product_id)->sum('qty');
                //dd($received_qty);
                $html.='<tr>
                    <td>'.++$sl.'</td>
                    <td>'.$info->requisitionProduct->product->name.'</td>
                    <td>'.$info->requisitionProduct->product->department->name.'</td>
                    <td>'.$info->requisitionProduct->product->group->name.'</td>
                    <td>'.$quantity.'</td>
                    <td> <strong class="bg-success text-center" style="padding: 10px 20px;border-radius: 18px 0;font-size: 1.3rem;letter-spacing: 4px;"> '.$received_qty.' </strong></td>
                    <td> <strong class="bg-default text-center" style="padding: 10px 20px;border-radius: 18px 0;font-size: 1.3rem;letter-spacing: 4px;"> '.($quantity-$received_qty).' </strong></td>
                    <td>'.$info->price.'</td>
                    <td>
                        <input type="number" value="'.($quantity-$received_qty).'" name="qty[]" class="form-control qtyCheck" data-qty="'.($quantity-$received_qty).'" data-rowId="'.$info->id.'"> 
                        <input type="hidden" value="'.$info->requisitionProduct->product_id.'" name="product_id[]" class="form-control"> 
                        <input type="hidden" value="'.$info->requisition_product_id.'" name="requisition_product_id[]" class="form-control"> 
                    </td>
                    <td> <strong id="rowId'.$info->id.'" class="bg-danger" style="padding: 5px 10px;">0</strong> '.$info->requisitionProduct->product->unit->name.' </td>
                   
                    <td> <textarea name="remarks[]" id="" cols="10" rows="1" class="form-control" placeholder="Remarks"></textarea> </td>
            </tr>';
            }
        }else{
            $html.='<tr><td colspan="11" class="text-center bg-danger">No Product Information Found</td></tr>';
        }

        return $html;
       // return json_encode(['success'=>$data]);
    }





}
