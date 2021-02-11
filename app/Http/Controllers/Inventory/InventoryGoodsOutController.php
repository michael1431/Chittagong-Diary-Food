<?php

namespace App\Http\Controllers\Inventory;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\GoodsinProduct;
use App\Employee;
use App\Invoice;
use App\AccessoriesStock;
use Auth;
use DB;

class InventoryGoodsOutController extends Controller
{
    public function convertRawToFinishedGoods(){
        $employees=Employee::all();
        $consumableProducts = Product::whereHas('accesories',function($q){
            $q->where('product_id','!=',null);
        })->with('accesories')->get();
        //dd($consumableProducts);
        $stockedProducts = Product::where('department_id','!=',1)->with('stocks')->get(); //here 1 means finished goods
        $finishGoods = Product::where('department_id',1)->get(); //here 1 means finished goods
        return view('inventory.goodsout.inventory-convert',compact('stockedProducts','finishGoods','employees','consumableProducts'));
    }
    public function storeRawToFinishedGoods(Request $request){
       //dd($request->all());
       try {
        // Begin database transaction
            DB::beginTransaction();
            if($request->consume_product){
                $goodsOutproduct=new AccessoriesStock;
                $goodsOutproduct->product_id=$request->consume_product_id;
                $goodsOutproduct->stock_out_qty=$request->stock_out_qty;
                $goodsOutproduct->user_id=Auth::user()->id;
                $goodsOutproduct->emp_id=$request->emp_id;
                $goodsOutproduct->remarks=$request->note;
                $goodsOutproduct->save();
            }elseif($request->damage_product){
                $goodsOutproduct=new GoodsinProduct;
                $goodsOutproduct->product_id=$request->finished_product_id;
                $goodsOutproduct->stock_out_qty=$request->stock_in_qty;
                $goodsOutproduct->price=$request->price; //cost of goods
                $goodsOutproduct->user_id=Auth::user()->id;
                $goodsOutproduct->remarks=$request->note;
                $goodsOutproduct->save();

                $invoice_no=Auth::user()->id.'-'.time();
                $amount=($request->price*$request->stock_in_qty);
                $invoice=new Invoice;
                $invoice->invoice_no =$invoice_no;
                $invoice->cost_id=damage_product_id();//cost type id;
                $invoice->total_amount = $amount;
                $invoice->total_paid = $amount;
                $invoice->status = 1; //0 means pending
                $invoice->event ='expense'; //
                $invoice->note =$request->note; //
                $invoice->user_id=Auth::user()->id;
                $invoice->payment_type=0; //cash  //bank //due
                $invoice->save();
            }else{
                $goodsOutproduct=new GoodsinProduct;
                $goodsOutproduct->product_id=$request->raw_product_id;
                $goodsOutproduct->stock_out_qty=$request->stock_out_qty;
                $goodsOutproduct->user_id=Auth::user()->id;
                $goodsOutproduct->remarks=$request->note;
                $goodsOutproduct->save();
               
                $goodsinproduct=new GoodsinProduct;
                $goodsinproduct->product_id=$request->finished_product_id;
                $goodsinproduct->qty=$request->stock_in_qty;
                $goodsinproduct->price=$request->price; //cost of goods
                $goodsinproduct->user_id=Auth::user()->id;
                $goodsinproduct->remarks=$request->note;
                $goodsinproduct->save();
            }
                DB::commit();
        } catch (\Exception $ex) {
                    // Rollback transactions if any errors occured
                    DB::rollBack();
                    dd($ex);
                    session()->flash('success','Goods Stock Converted Unsuccessful');
                    return redirect()->back()->withInput()->with('failed', $ex->getMessage());
        }
        session()->flash('success','Goods Stock Converted successfully');
        return redirect()->back();
    }
}
