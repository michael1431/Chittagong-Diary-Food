<?php

namespace App\Http\Controllers\Inventory;

use App\Group;
use App\Department;
use App\Requisition;
use App\Inventory\TempData;
use App\Product;
use App\ProductUnit;
use App\RequisitionProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class InventoryRequisitionController extends Controller
{
    public function index(){
        $codes = Product::pluck('item_code','id');
        $items = Product::pluck('name','id');
        $departments = Department::pluck('name','id');
        $groups = Group::pluck('name','id');
        $units = ProductUnit::pluck('name','id');

        return view('inventory.requisition.add-inventory-requisition',compact('codes','items','departments','groups','units'));
    }

    public function lists(){
        return view('inventory.requisition.item-list');
    }

    /* product find according to product id start */
    public function findProduct(Request $request){
        $id = $request->id;
       // dd($id);
        $products = Product::findOrFail($id);

        $data['unit'] = $products->unit->name;
        $data['price'] = $products->price;
        echo json_encode($data);

    }
    /* product find according to product id end */

    public function storeTempRequisitionInfo(Request $request){

        $request['user_id']= Auth::user()->id;
        //$request['type'] = 1;


        $exist = TempData::where([['type',$request->typ],['user_id',Auth::user()->id],['product_id',$request->product_id]])->get();
        if($exist->count()>0){
            TempData::where('type',$request->type)->where('product_id',$request->product_id)->where('user_id',Auth::user()->id)->update(['qty'=>$request->qty]);
        }else{
            TempData::create($request->all());
        }
        echo json_encode(['success'=>1]);

    }

    public function productLists()
    {
        if(request('sales_man_order')){
                $sl =0 ;
                $products = TempData::where([['type',5],['user_id',Auth::user()->id]])->get();
                foreach ($products as $product){
                    $dataId = $product->id;
                    $dataURL = route('inventory.requisition.item.remove');
                    echo    '<tr>
                                <td>'.++$sl.'</td>
                                <td>'.($product->product ? $product->product->item_code : "N/A").'</td>
                                <td>'.($product->product ? $product->product->name : "N/A").'</td>
                                <td>'.$product->price.'</td>
                                <td>'.$product->qty.'</td>
                                <td>'.$product->note.'</td>
                                <td> <button type="button" class="erase fa fa-trash btn btn-danger" data-id="'.$dataId.'" data-url="'.$dataURL.'"></button> </td>
                            </tr>';
                }
        }else{
                $products = TempData::where([['type',1],['user_id', Auth::user()->id]])->get();
                $sl =0 ;

                foreach ($products as $product){
                    $dataId = $product->id;
                    $dataURL = route('inventory.requisition.item.remove');
                    echo    '<tr>
                                <td>'.++$sl.'</td>
                                <td>'.($product->product->department ? $product->product->department->name : " N/A ").'</td>
                                <td>'.($product->product->group  ? $product->product->group->name : "N/A").'</td>
                                <td>'.($product->product ? $product->product->item_code : "N/A").'</td>
                                <td>'.($product->product ? $product->product->name : "N/A").'</td>
                                <td>'.($product->product->unit ? $product->product->unit->name : "N/A").'</td>
                                <td>'.$product->price.'</td>
                                <td> N / A</td>
                                <td> N / A</td>
                                <td>'.$product->qty.'</td>
                                <td> N / A</td>
                                <td>'.$product->note.'</td>
                                <td> <button type="button" class="erase fa fa-trash-alt btn btn-danger" data-id="'.$dataId.'" data-url="'.$dataURL.'"></button> </td>
                            </tr>';
                }
        }
    }

    public function removeItemFromList(Request $request){
        TempData::find($request->id)->delete();
    }


    /* purchase requisition store start */
    public function storePurchaseRequisition(Request $request){



        $price = $qty = 0;
        $products = TempData::where([['type',1],['user_id',Auth::user()->id]])->get();
        foreach ($products as $product){
            $price+=$product->price;
            $qty+=$product->qty;
        }

        $request['qty'] = $qty;
        $request['price'] = $price;
        $request['invoice_no'] = substr(md5(time()),0,6)."1";
        $request['user_id'] = Auth::user()->id;

        $invoice_id = Requisition::create($request->all());
        $price = $qty = 0;

        foreach ($products as $product){

            $save['price']=$product->price;
            $save['qty']=$product->qty;
            $save['note']=$product->note;
            $save['product_id']=$product->product_id;
            $save['requisition_id'] = $invoice_id->id;
            RequisitionProduct::create($save);
            TempData::find($product->id)->delete();
        }

        echo json_encode(['success'=>1]);

    }
    /* purchase requisition store end */

    /* Purchase requisitions list show start */
    public function requisitions(){
        $requisitions = Requisition::all();
        return view('inventory.requisition.requisitions-inventory',compact('requisitions'));
    }
    /* Purchase requisitions list show End */

    /* Individual Requisition Visit for checking */

    public function singleRequisition($id){
        $requisition = Requisition::find($id);
        return view('inventory.requisition.invoice-requisition',compact('requisition'));
    }

    /* view approved items as list start */
    public function viewApprovedItems($id){
        $requisition = Requisition::findOrFail($id);
        return view('inventory.requisition.view-approved-requisition-items',compact('requisition'));
    }
    /* view approved items as list end */



    public function checkingApproval(Request $request,$id){


        if (isset($request->product_id)){
            RequisitionProduct::where('requisition_id',$id)->update(['checking_note'=>null,'user_id'=>null]);

            foreach ($request->product_id as $item){
                $request['user_id'] = Auth::user()->id;
             /*   dd($request->all());*/
                RequisitionProduct::find($item)->update($request->except('product_id'));
                Requisition::find($id)->update(['check_user_id'=>Auth::user()->id]);
            }
        }/*else{
            // check if user uncheck all requisitions items and update status = 0 at Invoice Requisitions table
            $checkingRequisitions = Requisition::where('invoice_requisition_id',$id)->get();

            foreach ($checkingRequisitions as $info){
                    Requisition::findOrFail($info->id)->update(['checking_note'=>null,'user_id'=>null]);
            }
        }*/


        session()->flash('success','Checking Complete');
        return redirect()->route('inventory.purchase-requisition.view');
    }


    /* after check item list start */
    public function AftercheckingItemLists(){
        $requisitions = Requisition::whereNotNull('check_user_id')->get();
        return view('inventory.requisition.after-check-inventory-requisition',compact('requisitions'));
    }


    /* after check item list End */




}
