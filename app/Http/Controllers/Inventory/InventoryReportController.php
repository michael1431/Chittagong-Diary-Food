<?php

namespace App\Http\Controllers\Inventory;

use Illuminate\Http\Request;
use App\Invoice;
use App\Sale;
use Auth;
use App\GoodsinProduct;
use Carbon\Carbon;
use App\Http\Controllers\Controller;

class InventoryReportController extends Controller
{
    public function partiesStatus(Request $request)
    {
        $parties = [];
        if($request->related_party && $request->type){
            if($request->start && $request->end){
            $parties=$invoice=Invoice::whereStatus(1)->whereRelatedPartyType($request->type)->whereRelatedPartyId($request->related_party)->whereBetween('created_at', [$request->start, $request->end])->get();

            }else{
                $parties=$invoice=Invoice::whereStatus(1)->whereRelatedPartyType($request->type)->whereRelatedPartyId($request->related_party)->get();

            }
        }
        return view('admin.reports.due-status', compact('parties'));
    }
    public function partyCollection(Request $request)
    {
        if($request->party_id){
        $invoice=new Invoice;
        $inv_serial = Auth::user()->id.'-'.time();;
        $invoice->invoice_no = $inv_serial;
        $invoice->related_party_id = $request->party_id;
        $invoice->related_party_type =  $request->party_type;
        $invoice->total_paid = $request->amount;
        $invoice->total_return = $request->return;
        $invoice->note = $request->note;
        $invoice->event = $request->party_type=='Supplier' ? 'cash paid':'cash received';
        $invoice->status = 1;
        $invoice->save();

        return redirect()->route('parties.status',['type' =>$request->party_type,'related_party' => $request->party_id]);

        }else{
            return redirect()->back();
        }
    }
    // public function customerSupplierStatus($partyType,$id)
    // {
    // //    $type= ($partyType=='upplier') ? 'Supplier':'Customer';
    //    $invoice=Invoice::whereRelatedPartyType($partyType)->whereRelatedPartyId($id)->get();

    //     return $invoice;
    // }

    public function customerSupplierLoad(Request $request)
    {
        $html="";
        if($request->type=='Supplier'){
            $invoices = Invoice::whereStatus(1)->whereRelatedPartyType('Supplier')->groupBy('related_party_id')->get();
            foreach($invoices as $invoice){
                $html.="<option value='{$invoice->supplier->id}'>{$invoice->supplier->name}</option>";
            }
        }else{
            $invoices = Invoice::whereStatus(1)->whereRelatedPartyType('Customer')->groupBy('related_party_id')->get();
            foreach($invoices as $invoice){
                $html.=" <option value='{$invoice->customer->user_id}'>{$invoice->customer->name}</option>";
            }
        }
        return $html;

    }

    public function incomeReport(Request $request)
    {

        //that should be there
        $start=Carbon::parse($request->start);
        $end=Carbon::parse($request->end);

        $bInventory=0;
        $eInventory=0;

            $salesDataFromInvoice=Invoice::whereStatus(1)->whereRelatedPartyType('Customer')->get();
            $purchaseDataFromInvoice=Invoice::whereStatus(1)->whereRelatedPartyType('Supplier')->get();
            $expenseDataFromInvoice=Invoice::whereStatus(1)->where('cost_id','!=',null)->get()->groupBy('cost_id');
            $employeeDataFromInvoice=Invoice::whereStatus(1)->where('related_party_type','Employee')->get();
            $pstocks=GoodsinProduct::all()->groupBy('product_id');

                $j=0;
        foreach($expenseDataFromInvoice as $key => $exp){
            $operatingExp[$key]['account_head']=$exp->first()->cost->name;
            $operatingExp[$key]['amount']=$exp->sum('total_paid');
            $j=$key;
        }
        $operatingExp[$j+1]['account_head']='Employee Salary';
        $operatingExp[$j+1]['amount']=$employeeDataFromInvoice->sum('total_paid');
        //return $operatingExp;


        $purchase=0;
        foreach($pstocks as $stocks){
            foreach($stocks as $stock){
                if($stock->qty){
                $price=$stock->price;
                }
            }
            $purchase+=($stocks->sum('qty') * $price);
            $qty=($stocks->sum('qty') - $stocks->sum('stock_out_qty'));
            $eInventory+=($qty*$price);
        }


        $saleAmount=$salesDataFromInvoice->sum('total_amount');
        $salesReturn=$salesDataFromInvoice->sum('total_less');
        $discountOnSale=$salesDataFromInvoice->sum('total_discount');

        $purchaseAmount=$purchaseDataFromInvoice->sum('total_amount');
        //$purchaseAmount=$purchase;
        $purchaseReturn=$purchaseDataFromInvoice->sum('total_less');
        $discountOnPurchase=$purchaseDataFromInvoice->sum('total_discount');

        return view('admin.reports.income-statement', compact('saleAmount','salesReturn','discountOnSale','bInventory','purchaseAmount','purchaseReturn','discountOnPurchase','eInventory','operatingExp'));
    }
    public function incomeExpenseReport(Request $request){

        $where=[['created_at','>=', Carbon::today()->subDays(30)]];

        if(request('weekly')){
            $where=[['created_at','>=', Carbon::today()->subDays(7)]];
        }
        if(request('daily')){
            $where=[['created_at', Carbon::today()]];
        }

        $sales=Sale::where($where)
                ->with(['product','product.stocks'])
                ->get()
                ->groupBy(function($item){
                    return $item->created_at->format('d-M-y');
                });


        $expenses=Invoice::whereStatus(1)->where('cost_id','!=',null)
                ->where($where)
                ->get()
                ->groupBy(function($item){
                    return $item->created_at->format('d-M-y');
                });
        $dateGroups=Invoice::where($where)->whereStatus(1)->get()->groupBy(function($item){
            return $item->created_at->format('d-M-y');
        });
        if(request('start') && request('end')){
            $sales=Sale::whereBetween('created_at',[ request('start') , request('end')])->with(['product','product.stocks'])->get()->groupBy(function($item){
                return $item->created_at->format('d-M-y');
             });
            $expenses=Invoice::whereStatus(1)->where('cost_id','!=',null)->whereBetween('created_at',[ request('start') , request('end')])->get()->groupBy(function($item){
                return $item->created_at->format('d-M-y');
            });
            $dateGroups=Invoice::whereStatus(1)->whereBetween('created_at',[ request('start') , request('end')])->get()->groupBy(function($item){
                return $item->created_at->format('d-M-y');
            });
            return view('admin.reports.income-expense', compact('sales','expenses','dateGroups'));
        }
        // $sales=Sale::where($where)
        //         ->with(['product','product.stocks'])
        //         ->get()
        //         ->groupBy(function($item){
        //             return $item->created_at->format('d-M-y');
        //             });

        // $expenses=Invoice::whereStatus(1)->where('cost_id','!=',null)
        //         ->where($where)
        //         ->get()
        //         ->groupBy(function($item){
        //             return $item->created_at->format('d-M-y');
        //         });
    //   $dateGroups=Invoice::whereStatus(1)->get()->groupBy(function($item){
    //     return $item->created_at->format('d-M-y');
    // });
     // dd($dateGroups);
        return view('admin.reports.income-expense', compact('sales','expenses','dateGroups'));
    }

    // public function barcodeget(){
    //     $product = Product::where('product_code', '!=' , null)->get();
    //     return view('admin.report.barcode',compact('product'));
    // }
    // public function barcodepost(Request $request)
    // {
    //     $request->validate([
    //         'barcodeData'=>'required',
    //         'barcodeQty'=>'required|numeric|max:20|min:1',
    //     ]);

    //         // return $request; ¯\_(ツ)_/¯
    //     $product = Product::where('product_code', '!=' , null)->get();

    //     $product_searched = Product::where('product_code','=',trim(str_before($request->barcodeData,'--')))
    //     ->first();
    //     $barcode = [];
    //     $barcode['productbarcode'] = trim(str_before($request->barcodeData,'--'));
    //     $barcode['productsku'] =$product_searched->product_name;
    //     $barcode['productname'] = $barcode['productsku'];
    //         // $barcode['productattribute'] = str_after($barcode['productsku'],'|');
    //     $barcode['barcode_column'] = $request->barcode_column;

    //     $product_price =$product_searched->product_price;
    //     //  Branch_inventory::with('purchase')
    //     // ->wherehas('product',function($query)use($barcode){
    //     //     $query->where('product_barcode','=',$barcode['productbarcode']);
    //     // })
    //     // ->wherehas('purchase',function($query){
    //     //     $query->orderBy('created_at','ASC');
    //     // })->first();

    //     if($product_price){
    //         $barcode['product_price'] = $product_price;
    //     }else{
    //         $barcode['product_price'] = "Not Available";
    //     }
    //     $productSearch = Product::where('product_code','=',$barcode['productbarcode'])->count();
    //         if($productSearch == 0){
    //             return redirect()->back()->withErrors('No such  product found!');
    //         }
    //      $barcode['qty'] = $request->barcodeQty;
    //      $barcode['show_product_name'] = $request->product_name=='on'?true:false;
    //     //  $barcode['show_product_attribute'] = $request->product_attribute=='on'?true:false;
    //      $barcode['show_product_price'] = $request->selling_price=='on'?true:false;
    //      $barcode['show_product_barcode'] = $request->barcode_number=='on'?true:false;
    //      $barcode['barcode_per_column'] = $request->barcode_column;

    //      $barcode['barcode_type'] = 'TYPE_EAN_13';//product_barcode_type;
    //     //  $barcode;
    //      return view('admin.report.barcode',compact('product','barcode'));
    // }
}
