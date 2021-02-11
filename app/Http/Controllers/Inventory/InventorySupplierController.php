<?php

namespace App\Http\Controllers\Inventory;

use App\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class InventorySupplierController extends Controller
{
    public function index(){
        $suppliers = Supplier::all();
        return view('inventory.supplier.add-supplier-inventory',compact('suppliers'));
    }

    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'phone'=>'required|unique:suppliers',
        ]);

        Supplier::create($request->all());
        session()->flash('success','Party / Supplier successfully stored / Saved');
        return redirect()->route('inventory.supplier.add');
    }

    public function edit($id){
        $suppliers = Supplier::all();
        $supplier = Supplier::findOrFail($id);
        return view('inventory.supplier.edit-supplier-inventory',compact('suppliers','supplier'));
    }

    public function update(Request $request,$id){
        $this->validate($request,[
            'name'=>'required',
            'phone'=>['required',Rule::unique('suppliers')->ignore($id)],
        ]);

        Supplier::findOrFail($id)->update($request->all());
        session()->flash('success','Party / Supplier successfully Updated');
        return redirect()->route('inventory.supplier.add');
    }

    public function destroy(Request $request){
        Supplier::findOrFail($request->id)->delete();
    }
}
