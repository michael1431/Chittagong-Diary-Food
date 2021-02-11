<?php

namespace App\Http\Controllers\Inventory;

use App\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class InventoryDepartmentController extends Controller
{
    public function index(){
        $departments = Department::all();
        return view('inventory.department.add-department',compact('departments'));
    }

    public function store(Request $request){
        Department::create($request->all());
        session()->flash('success','Inventory Department Successfully stored in ERP System');
        return redirect()->route('inventory.department.add');
    }

    public function edit($id){
        $department = Department::findOrFail($id);
        $departments = Department::all();
        return view('inventory.department.edit-department-inventory',compact('department','departments'));
    }

    public function update(Request $request,$id){
        $this->validate($request,[
            'name'=>['required',Rule::unique('departments')->ignore($id)]
        ]);
        Department::findOrFail($id)->update($request->all());
        session()->flash('success','Inventory Department Successfully updated in ERP System');
        return redirect()->route('inventory.department.add');
    }

    public function destroy(Request $request){
        Department::findOrFail($request->id)->delete();
    }

}
