<?php

namespace App\Http\Controllers\Inventory;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Department;
use App\Group;
use App\Product;
use App\ProductUnit;

class ProductController extends Controller
{
    public function index()
    {
        $items = Product::paginate(100);
        $departments = Department::all()->pluck('name','id');
        $groups = Group::all()->pluck('name','id');
        $units = ProductUnit::all()->pluck('name','id');
        return view('inventory.item.add-item',compact('items','departments','groups','units'));
    }
    public function dataViaApi()
    {
        
        $items = Product::all();
        // $departments = Department::all()->pluck('name','id');
        // $groups = Group::all()->pluck('name','id');
        // $units = ProductUnit::all()->pluck('name','id');
        return response()->json(['data' => $items], 200);
    }

    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'item_code'=>'required|unique:products',
            'product_unit_id'=>'required',
            'department_id'=>'required',
            'group_id'=>'required',
            'price'=>'required',
            'mrp'=>'required',
        ]);

       /* dd($request->all());*/

        Product::query()->create($request->all());
        session()->flash('success','Item information successfully stored');
        return redirect()->route('inventory.item.add');
    }

    public function edit($id){
        $items = Product::all();

        $departments = Department::all()->pluck('name','id');
        $groups = Group::all()->pluck('name','id');
        $units = ProductUnit::all()->pluck('name','id');
        $item = Product::query()->findOrFail($id);

     //   dd($item->unit);

        return view('inventory.item.edit-item-inventory',compact('items','departments','groups','units','item'));

    }

    public function update(Request $request,$id){
        Product::query()->findOrFail($id)->update($request->all());
        session()->flash('success','Item information successfully updated');
        return redirect()->route('inventory.item.add');
    }

    public function destroy(Request $request){
        Product::query()->findOrFail($request->id)->delete();
    }

    /* department wise Product List start */

    public function groupWiseProducts(Request $request){
        $products = ($request->group_id !=null ? Product::where('group_id',$request->group_id)->get() : Product::all() );

        $sl=0;
        $n = 0;
        //dd(["total"=>$products->count()]);
            foreach ($products as $key=>$product){

                   /* $data['sl'][$key] = ++$sl;
                    $data['name'][$key] = $product->name;
                    $data['code'][$key] = $product->item_code;
                    $data['group'][$key] = $product->group_id !=null ? $product->group->name : "N/A";
                    $data['unit'][$key] = $product->product_unit_id !=null ? $product->unit->name : "N/A";
                    $data['department'][$key] = $product->department_id !=null ? $product->department->name : "N/A";
                    $data['price'][$key] = $product->price;
                    $data['description'][$key] = $product->description;
                    $data["edit"][$key] =  '<a href="'.route('inventory.item.edit',$product->id).'" class="btn btn-edit btn-success far fa-edit"></a>  <button type="button" data-id="'.$product->id.'" data-url="'.route('inventory.item.destroy').'" class="btn btn-danger fas fa-trash-alt erase"></button>';*/


                /*$data[$key]['sl'] = ++$sl;
                $data[$key]['name'] = $product->name;
                $data[$key]['code'] = $product->item_code;
                $data[$key]['group'] = $product->group_id !=null ? $product->group->name : "N/A";
                $data[$key]['unit'] = $product->product_unit_id !=null ? $product->unit->name : "N/A";
                $data[$key]['department'] = $product->department_id !=null ? $product->department->name : "N/A";
                $data[$key]['price'] = $product->price;
                $data[$key]['description'] = $product->description;
                $data[$key]["edit"] =  '<a href="'.route('inventory.item.edit',$product->id).'" class="btn btn-edit btn-success far fa-edit"></a>  <button type="button" data-id="'.$product->id.'" data-url="'.route('inventory.item.destroy').'" class="btn btn-danger fas fa-trash-alt erase"></button>';*/

                $data[] = [
                         "sl"=> ++$sl ,
                         "name"=> $product->name,
                         "code"=> $product->item_code,
                         "group" => $product->group_id !=null ? $product->group->name : "N/A",
                         "unit" => $product->product_unit_id !=null ? $product->unit->name : "N/A",
                         "department" => $product->department_id !=null ? $product->department->name : "N/A",
                         "price" => $product->price,
                         "description" => $product->description,
                         "edit" => '<a href="'.route('inventory.item.edit',$product->id).'" class="btn btn-edit btn-success far fa-edit"></a>
                        <button type="button" data-id="'.$product->id.'" data-url="'.route('inventory.item.destroy').'" class="btn btn-danger fas fa-trash-alt erase"></button>'
                ];


               /* $data[] = [
                    ++$sl ,
                    $product->name,
                    $product->item_code,
                    $product->group_id !=null ? $product->group->name : "N/A",
                    $product->product_unit_id !=null ? $product->unit->name : "N/A",
                    $product->department_id !=null ? $product->department->name : "N/A",
                    $product->price,$product->description,
                    '<a href="'.route('inventory.item.edit',$product->id).'" class="btn btn-edit btn-success far fa-edit"></a>
                    <button type="button" data-id="'.$product->id.'" data-url="'.route('inventory.item.destroy').'" class="btn btn-danger fas fa-trash-alt erase"></button>'
                ];*/

            }

           // dd($data);

           //    return $row;

          return json_encode(["draw"=>(isset($_REQUEST["draw"]) ? $_REQUEST["draw"] : 0),'recordsTotal'=>$products->count(),'recordsFiltered'=>$products->count() , 'data'=>$data]);
        //  return json_encode(["data"=>$data]);

    }

    /* department wise Product List End */


}
