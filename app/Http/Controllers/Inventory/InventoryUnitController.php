<?php

namespace App\Http\Controllers\Inventory;

use App\ProductUnit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class InventoryUnitController extends Controller
{
    public function index(){
        $units = ProductUnit::all();
        return view('inventory.unit.add-unit-inventory',compact('units'));
    }

    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required|unique:product_units'
        ]);

        ProductUnit::create($request->all());
        session()->flash('success','Inventory Unit Successfully stored in ERP System');
        return redirect()->route('inventory.unit.add');
    }

    public function edit($id){
        $unit = ProductUnit::findOrFail($id);
        $units = ProductUnit::all();
        return view('inventory.unit.edit-unit-inventory',compact('unit','units'));
    }

    public function update(Request $request,$id){
        $this->validate($request,[
            'name'=>['required',Rule::unique('product_units')->ignore($id)]
        ]);
        ProductUnit::findOrFail($id)->update($request->all());
        session()->flash('success','Inventory Unit Successfully updated in ERP System');
        return redirect()->route('inventory.unit.add');

    }

    public function destroy(Request $request){
        ProductUnit::findOrFail($request->id)->delete();
    }
}
