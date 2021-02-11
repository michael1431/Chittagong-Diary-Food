<?php

namespace App\Http\Controllers\Inventory;

use App\Group;
use App\Product;
use App\ProductUnit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FileUploadController extends Controller
{
    public function index(){
        return view('inventory.excel');
    }

    public function store(Request $request){

        $fileName = substr(md5(time()),0,6).'.'.$request->file('excel')->getClientOriginalExtension();
        $request->file('excel')->move(base_path('public/upload/'),$fileName);
        $path = asset('upload/'.$fileName);
        $file_lines = file($path);
        $row  = count($file_lines);


        $tr='';
        echo '<!DOCTYPE html>
                <html lang="en">
                <head>
                  <title>Bootstrap Example</title>
                  <meta charset="utf-8">
                  <meta name="viewport" content="width=device-width, initial-scale=1">
                  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
                  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
                  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
                </head>
                <body>
                  <div class="row">
                  ';





        for ($sl=0;$sl<=$row;$sl++){
            $print = $row-$sl;
            if($print !=0){
                $slice = ($sl !=0 ? $sl : 1);

                $x = explode(',', $file_lines[$slice]);
                $product['name'] = $x[0];
                $product['item_code'] = $x[1];

                /* Create new Group Or Get Created Group ID*/
                $group = Group::updateOrCreate(['name'=>$x[2]]);

                $unit = ProductUnit::updateOrCreate(['name'=>$x[3]]);

                $product['group_id'] = $group->id;
                $product['product_unit_id'] = $unit->id;

                /* already exit or not */

                $exit = Product::where('name',$x[0])->where('item_code',$x[1])->where('group_id',$group->id)->where('product_unit_id',$unit->id)->get()->count();
                  $print_div = '<div class="col-lg-3" style="padding: 0">
                                    <div style="padding: 30px;margin: 10px;border: 1px solid darkgreen;" class="bg-primary">
                                        <label>SL : '.$sl.'</label>
                                        <h5>Name : '.$product['name'].'</h5>
                                        <h5>Code : '.$x[1].'</h5>
                                        <h5>Group : '.$x[2].'</h5>
                                        <h5>Unit : '.$x[3].'</h5>
                                    </div>
                                </div>';
                if ($exit>0){
                    echo $print_div;
                }
                else{
                    if (!empty($x[0] && !empty($x[1]))){
                        Product::create($product);
                        $print_div;
                    }else{
                        $print_div;
                    }
                }
            }
        }
        echo '</div>
            </div>
            <h1>'.$row.'</h1>
        </body>
        </html>
        ';
    }
}
