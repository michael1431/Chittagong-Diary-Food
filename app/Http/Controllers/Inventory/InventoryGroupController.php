<?php

namespace App\Http\Controllers\Inventory;

use App\Group;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class InventoryGroupController extends Controller
{
    public function index(){
        $groups = Group::all();
        return view('inventory.group.add-group-inventory',compact('groups'));
    }

    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required|unique:groups',
        ]);

        Group::create($request->all());
        session()->flash('success','Inventory Group Successfully stored in ERP System');
        return redirect()->route('inventory.group.add');
    }

    public function edit($id){
        $group = Group::findOrFail($id);
        $groups = Group::all();
        return view('inventory.group.edit-group-inventory',compact('group','groups'));
    }

    public function update(Request $request,$id){
        $this->validate($request,[
            'name'=>['required',Rule::unique('groups')->ignore($id)]
        ]);
        Group::findOrFail($id)->update($request->all());
        session()->flash('success','Inventory Group Successfully updated in ERP System');
        return redirect()->route('inventory.group.add');

    }

    public function destroy(Request $request){
        Group::findOrFail($request->id)->delete();
    }
}
