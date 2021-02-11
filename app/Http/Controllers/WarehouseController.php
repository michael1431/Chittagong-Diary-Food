<?php

namespace App\Http\Controllers;

use App\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class WarehouseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $warehouses = Warehouse::all();
        return view('inventory.warehouse.add-warehouse',compact('warehouses'));
    }

    public function show($id){
        $warehouse = Warehouse::findOrFail($id);
        $warehouses = Warehouse::all();
        return view('inventory.warehouse.edit-warehouse',compact('warehouses','warehouse'));
    }

    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required|unique:warehouses'
        ]);

        Warehouse::create($request->all());
        session()->flash('success','Warehouse successfully stored in your system');
        return redirect()->route('warehouse.add');
    }

    public function update(Request $request,$id){
        $this->validate($request,[
            'name'=>['required',Rule::unique('warehouses')->ignore($id)]
        ]);

        Warehouse::findOrFail($id)->update($request->all());
        session()->flash('success','Warehouse successfully updated in your system');
        return redirect()->route('warehouse.add');
    }

    public function destroy(Request $request){
        Warehouse::findOrFail($request->id)->delete();
    }


}
