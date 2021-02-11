<?php

namespace App\Http\Controllers\Inventory;

use App\Purchase;
use App\Invoice;
use App\Quotation;
use App\Requisition;
use App\Supplier;
use App\QuotationProduct;
use App\RequisitionProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class InventoryPurchaseController extends Controller
{
    public function index(){
        $requisitions = \App\Requisition::whereNotNull('check_user_id')->get();
        return view('inventory.purchase.pending-purchase-requisition',compact('requisitions'));
    }

    public function approved(){
        return view('inventory.purchase.approved-history');
    }



    /* quotation making  start */
    public function makeQuotation($id){
        $suppliers = Supplier::all();
        $invoice_requisition = Requisition::findOrFail($id);
        if($invoice_requisition ==null){
            return view('errors.404');
        }

        $quotations = RequisitionProduct::whereNotNull('user_id')->where('requisition_id',$id)->get();
        return view('inventory.purchase.add-quotation-inventory-requisition',compact('quotations','invoice_requisition','suppliers'));
    }
    /* quotation making end */


    /* quotation store start */
    public function storeQuotation(Request $request,$id){
        $supplier_id = $request->supplier_id;
        if ($supplier_id === '0'){
            return redirect()->route('inventory.quotation.add',$id)->with('error','Please Select Supplier');
        }


        /* quotation invoice store start */
        $price=$qty=0;

        foreach ($request->requisition_product_id as $key=>$requisition_id){
            $price+=$request->price[$key];
        }
        $invoice_quotation = Quotation::where([['supplier_id', $request->supplier_id],['requisition_id',$id]])->first();
        if($invoice_quotation != null){
                $invoice_quotation->update([
                    'requisition_id'=>$id,
                    'supplier_id'=>$request->supplier_id,
                    'user_id'=>Auth::id(),
                    'price'=>$price,
                    'qty'=>1,
                ]);
        }else{

            $invoice_quotation = Quotation::create([
                'requisition_id'=>$id,
                'supplier_id'=>$request->supplier_id,
                'user_id'=>Auth::user()->id,
                'price'=>$price,
                'qty'=>1,
            ]);
        }
        /* quotation invoice store End */

        /* quotation store start */
        foreach ($request->requisition_product_id as $key=>$requisition_id){
            $requisition=RequisitionProduct::find($requisition_id);

            $quotationProduct = QuotationProduct::where([
                ['quotation_id',$invoice_quotation->id],
                ['requisition_id', $id],
                ['supplier_id',$request->supplier_id],
                ["requisition_product_id",$requisition_id]
            ])->latest()->first();

            if($quotationProduct != null){
                $quotationProduct->update([
                    'quotation_id'=>$invoice_quotation->id,
                    'requisition_id'=>$id,
                    'supplier_id'=>$request->supplier_id,
                    "requisition_product_id"=>$requisition_id,
                    'user_id'=>Auth::id(),
                    'price'=>$request->price[$key],
                    'qty'=>$requisition->qty
                ]);
            }else{
                QuotationProduct::create([
                    'quotation_id'=>$invoice_quotation->id,
                    'requisition_id'=>$id,
                    'supplier_id'=>$request->supplier_id,
                    'requisition_product_id'=>$requisition_id,
                    'user_id'=>Auth::user()->id,
                    'price'=>$request->price[$key],
                    'qty'=>$requisition->qty
                ]);
            }
        }
        /* quotation store end */

        session()->flash('success','Quotation complete');
        return redirect()->route('inventory.requisition.purchase');


    }
    /* quotation store end */

    /* Quotation Lists start */
    public function quotationLists(){
        $requisitions = Requisition::all();
        return view('inventory.purchase.requisition-quotation-lists',compact('requisitions'));
    }
    /* Quotation lists End */

    /* Quotations fetch start */
    public function allQuotations($id){

       // $quotations = QuotationProduct::where('requisition_id',$id)->get(['supplier_id','quotation_id','requisition_id'])->groupBy('supplier_id');
        $query_line = 'SELECT supplier_id,quotation_id,requisition_id FROM `quotation_products` WHERE requisition_id= '.$id.' GROUP BY supplier_id';
        $quotations = DB::select($query_line);
        /*if ($quotations->count()==0){
            return redirect()->route('inventory.requisition.quotation.list');
        }*/

        if (count($quotations)==0){
            return redirect()->route('inventory.requisition.quotation.list');
        }

        $requisition = Requisition::findOrFail($id);
        return view('inventory.purchase.supplier-quotation',compact('quotations','requisition'));
    }
    /* Quotations fetch end */

    /* comparative Statement for Individual Requisitions start */

    public function comparativeStatementQuotations($id)
    {
        $suppliers = QuotationProduct::where('requisition_id',$id)->get()->groupBy('supplier_id');
        $products = QuotationProduct::where('requisition_id',$id)->get()->groupBy('requisition_product_id');
        $requisition = Requisition::findOrFail($id);
        return view('inventory.purchase.comparative-statement',compact('products','requisition','suppliers'));

    }

    /* Comparative statement for individual requisitions end */


    public function order(){
        $requisitions = Requisition::all();
        return view('inventory.purchase.purchase-order',compact('requisitions'));
    }

    public function requisitionQuotationList(Request $request){
        $quotations = Quotation::where('requisition_id',$request->requisition_id)->get();

        $html = '<option value="0">Select Party Quotation </option>';

        foreach ($quotations as $quotation){
            $html.='<option value="'.$quotation->id.'">  Party : '.$quotation->supplier->name.' ( '.$quotation->supplier->phone.' )  </option>';
        }
        return $html;
    }

    public function store(Request $request){
        $requisition_id = $request->requisition_id;
        $quotation_id = $request->quotation_id;
        $lc_no=$request->lc_no;

         $quotation=QuotationProduct::where([['requisition_id',$requisition_id],['quotation_id',$quotation_id]])->get();
         $amount=0;
         foreach($quotation as $q){
            $amount+=($q->price*$q->qty);
            $supplier_id=$q->supplier_id;
         }

        $inv_serial = Auth::user()->id.'-'.time();;
        $invoice_no = $inv_serial;

        if ($requisition_id != 0 && $quotation_id != 0 ){
            $invoice=new Invoice;
            $invoice->invoice_no =$invoice_no;
            $invoice->lc_no =$lc_no ?? $invoice_no;
            $invoice->related_party_id = $supplier_id;
            $invoice->related_party_type = 'Supplier';
            $invoice->total_amount = $amount;
            $invoice->status = 1; //0 means pending
            $invoice->event ='purchase'; //
            $invoice->user_id=Auth::user()->id;
            $invoice->payment_type=3; //cash  //bank //due
//            $invoice->save();
            $request['invoice_no']=$invoice_no;
            $request['user_id'] = Auth::user()->id;
            Purchase::create($request->all());
            echo json_encode(['success'=>1]);
        }else{
          echo json_encode(['success'=>0]);
        }

    }


    public function summaryPurchase(){
        $purchases = Purchase::all();
        return view('inventory.purchase.summary-purchase',compact('purchases'));
    }


    /* Print start */
    public function printPurchaseOrder($id){
        $invoice = Invoice::find($id);
        $delete = $invoice->delete();
        // return back();
        if($delete){
            return response(['success'=>true]);
        }
        return response(['success'=>false]);
        $purchase = Purchase::findOrFail($id);
        return view('inventory.purchase.print-purchase-order',compact('purchase'));
    }
    /* Print End */


}
