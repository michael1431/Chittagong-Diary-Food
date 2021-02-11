<?php

namespace App\Http\Controllers;

use App\Department;
use App\Goodsin;
use App\GoodsinProduct;
use App\Group;
use App\Product;
use App\RequisitionProduct;
use App\Warehouse;
use App\AccessoriesStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    public function index(){
      //  dd("adsfsadf");
        $goodsin = Goodsin::all();
        $warehouses = Warehouse::pluck('name','id');
        $sections = Department::pluck('name','id');
        $groups = Group::pluck('name','id');
        $products = Product::pluck('name','id');
        
        // $query = "SELECT SUM(qty) as qty , p.name ,d.name AS department,g.name AS groupName FROM goodsin_products AS gp, products as p , departments AS d , groups AS g WHERE gp.product_id=p.id AND p.group_id =g.id AND p.department_id = d.id GROUP BY gp.product_id";
        // $stocks = DB::select($query);
        $return_data=array();
        $stocks=GoodsinProduct::all();
        $giftStocks=AccessoriesStock::all();
        $gift_group=$giftStocks->groupBy('product_id');
        $stock_group=$stocks->groupBy('product_id');

        $k=0;
        $nKey=0;
        foreach($stock_group as $key=>$sgv){
            $qty=0;
            foreach($sgv as $inf){
                $name= $inf->product->name;
                $department= $inf->product->department->name;
                $group= $inf->product->group->name;
                $qty=($qty+$inf->qty);
                $qty=($qty-$inf->stock_out_qty);
            }
            $return_data[$k]['name']= $name;
            $return_data[$k]['department']= $department;
            $return_data[$k]['group']= $group;
            $return_data[$k]['qty']= $qty;
            $k++;
            $nKey=$k;
        }

        foreach($gift_group as $ggv){
            $qty=0;
            foreach($ggv as $inf){
                $name= $inf->product->name;
                $department= $inf->product->department->name;
                $group= $inf->product->group->name;
                $qty=($qty+$inf->stock_in_qty);
                $qty=($qty-$inf->stock_out_qty);
            }
            $return_data[$nKey]['name']= $name;
            $return_data[$nKey]['department']= $department;
            $return_data[$nKey]['group']= $group;
            $return_data[$nKey]['qty']= $qty;
            $nKey++;
        }
       //return $return_data;
        return view('inventory.stock.view-stock',compact('goodsin','warehouses','sections','groups','products','return_data'));
    }

    /* Product Wise Start*/

    public function productWise(Request $request){

        $stocks=GoodsinProduct::where('product_id',$request->product_id)->get();
        $gift_stocks=AccessoriesStock::where('product_id',$request->product_id)->get();
        //return $stocks;
        //$stocks = DB::select($query);
        $sl=0;
        $qty=0;
        // foreach ($stocks as $key=>$info){
        //     $name= $info->product->name;
        //     $department= $info->product->department ? $info->product->department->name : '';
        //     $group=$info->product->group ? $info->product->group->name : '';
        //     $qty=$qty + $info->qty;
        //     $qty= $qty-$info->stock_out_qty;
        // }
        $stk=0;
        $return_data='<thead><tr><th>Date</th><th>ProductName</th><th>Stock IN</th><th>Stock OUT</th><th>Stock</th><th>Remarks</th></tr></thead><tbody>';
            foreach($stocks as $stock){
                $return_data.='<tr><td>'.(date('d-M-Y',strtotime($stock->created_at))).'</td><td>'.$stock->product->name.'</td><td>'.$stock->qty.'</td><td>'.$stock->stock_out_qty.'</td>';
                    $stk+=($stock->qty-$stock->stock_out_qty);
                    $return_data.='<td>'.$stk.'</td><td>'.$stock->remarks.'</td></tr>';
            }
            $return_data.='</tbody>';
        // $data['sl'][$sl] = $sl;
        // $data['name'][$sl] =$name;
        // $data['department'][$sl] =$department;
        // $data['group'][$sl] =$group;
        // $data['qty'][$sl]= $qty;

        return $return_data;
    }

    /* Product Wise End */

    /* Stock Summary Start */

    public function stockReport(Request $request){

        $id = $request->id;
        $type = $request->type; // type == 1 Means Department ID , type == 2 Means Group ID
        // $query = "SELECT SUM(qty) as qty , p.name ,d.name AS department,g.name AS groupName FROM goodsin_products AS gp, products as p , departments AS d , groups AS g WHERE ";
        // if($type == 1){
        //     $query.=" gp.department_id =".$id." GROUP BY gp.product_id";
        // }else{
        //     $query.=" gp.group_id =".$id." GROUP BY gp.product_id";
        // }


        $stocks = DB::select($query);

        if($stocks){
            $sl =0;
            foreach ($stocks as $key=>$info){
                $data['sl'][$key] = ++$sl;
                $data['name'][$key]= $info->name;
                $data['department'][$key]= $info->department;
                $data['group'][$key]= $info->groupName;
                $data['qty'][$key]= $info->qty;
            }
            return json_encode(['success'=>$data]);
        }else{
            return json_encode(['success'=>0]);
        }


    }


    /* Stock Summary End */


}
