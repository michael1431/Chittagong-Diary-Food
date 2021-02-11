<?php

namespace App\Http\Controllers;

use App\Cost;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $costs = Cost::all();
        return view('inventory.cost.add-cost',compact('costs'));
    }

    public function show($id){
        $cost = Cost::findOrFail($id);
        $costs = Cost::all();
        return view('inventory.cost.edit-cost',compact('costs','cost'));
    }

    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required|unique:costs'
        ]);

        Cost::create($request->all());
        session()->flash('success','Cost successfully stored in your system');
        return redirect()->route('cost.add');
    }

    public function update(Request $request,$id){
        $this->validate($request,[
            'name'=>['required',Rule::unique('costs')->ignore($id)]
        ]);

        Cost::findOrFail($id)->update($request->all());
        session()->flash('success','Cost successfully updated in your system');
        return redirect()->route('cost.add');
    }

    public function destroy(Request $request){
        Cost::findOrFail($request->id)->delete();
    }
}
