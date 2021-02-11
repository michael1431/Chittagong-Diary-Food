<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Role;
use App\User;
//use Route;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        $roles=Role::where('id','!=',1)->get();
       //return $roles;
        return view('admin.employee.add-employee',compact('employees','roles'));
    }

    public function store(Request $request)
    {
        $data = $request->except('image');
        if($request->email){
            $request->validate([
                'email' => 'required|unique:users',
                'password' => 'required',
                'name' => 'required',
            ]);

            $user=new User;
            $user->name=$request->name;
            $user->email=$request->email;
            $user->password=bcrypt($request->password);
            $user->role_id=$request->role; //'employee'
            $user->save(); 
            $data['user_id']=$user->id;
        }
       // dd($request->all());
        
        $filename='public/demo/employee.jpg';
        
        if($request->file('image')){
            $image = $request->file('image');
            $filename = Date('Y')."_".substr(md5(time()),0,6).".".$image->getClientOriginalExtension();           
            $image->move(base_path('public/admin/employee/upload/'),$filename);
        }
        $data['image'] = $filename;
        
        Employee::create($data);
        session()->flash('success','Employee has store Successfully complete');
        return redirect()->route('employee.add');
    }

    public function show($id)
    {
        $roles=Role::where('id','!=',1)->get();
        $employee = Employee::find($id);
        return view('admin.employee.edit-employee',compact('employee','roles'));
    }

    public function edit($id)
    {

    }

    public function update(Request $request)
    {
       
        $employee = Employee::find($request->id);
        if($request->has('image')){
            $path = "public/admin/employee/upload/".$employee->image;
            unlink($path);
            $image = $request->file('image');
            $filename = Date('Y')."_".substr(md5(time()),0,6).".".$image->getClientOriginalExtension();
            $data = $request->except('image');
            $data['image'] = $filename;
            $image->move(base_path('public/admin/employee/upload/'),$filename);
            $employee->update($data);
        }else{
            $data = $request->except('image');
            if($request->email){
                $request->validate([
                    'email' => 'required',
                    'password' => 'required',
                    'name' => 'required',
                ]);
                if($employee->user_id){
                    $user= User::find($employee->user_id);
                    $user->name=$request->name;
                    $user->email=$request->email;
                    $user->password=bcrypt($request->password);
                    $user->role_id=2; //'employee'
                    $user->update(); 
                    //$data['user_id']=$user->id;
                }else{
                    $user=new User;
                    $user->name=$request->name;
                    $user->email=$request->email;
                    $user->password=bcrypt($request->password);
                    $user->role_id=$request->role; //'employee'
                    $user->save(); 
                    $data['user_id']=$user->id;
                }
            }
            // $employee->update($request->all());
            $employee->update($data);
        }

        session()->flash('success','Employee has update Successfully complete');
        return redirect()->route('employee.add');
    }

    public function destroy(Request $request)
    {
        $employee = Employee::find($request->id);
        $path = "public/admin/employee/upload/".$employee->image;
        unlink($path);
        $employee->delete();
    }
}
