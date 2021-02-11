<?php

namespace App\Http\Controllers\Inventory;

use App\Inventory\Department;
use App\Inventory\GroupInventory;
use App\Inventory\InventoryItem;
use App\Inventory\UnitInventory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InventoryItemController extends Controller
{
    public function index()
    {
        $items = InventoryItem::all();
        $departments = Department::pluck('name','id');
        $groups = GroupInventory::pluck('name','id');
        $units = UnitInventory::pluck('name','id');
        return view('inventory.item.add-item',compact('items','departments','groups','units'));
    }

    public function store(Request $request){

        InventoryItem::create($request->all());
        session()->flash('success','Item information successfully stored');
        return redirect()->route('inventory.item.add');
    }

    public function edit($id){
        $items = InventoryItem::all();
        $departments = Department::pluck('name','id');
        $groups = GroupInventory::pluck('name','id');
        $units = UnitInventory::pluck('name','id');
        $item = InventoryItem::findOrFail($id);
        return view('inventory.item.edit-item-inventory',compact('items','departments','groups','units','item'));

    }

    public function update(Request $request,$id){
        InventoryItem::findOrFail($id)->update($request->all());
        session()->flash('success','Item information successfully updated');
        return redirect()->route('inventory.item.add');
    }

    public function destroy(Request $request){
        InventoryItem::findOrFail($request->id)->delete();
    }

}
