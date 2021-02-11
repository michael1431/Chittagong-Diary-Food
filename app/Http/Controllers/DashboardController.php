<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\Permission;
use App\Role;
use App\Invoice;
use App\Hrm\Employee;
use App\Hrm\EmployeeOffice;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;
class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // $where=[['created_at','>=', Carbon::today()->subDays(30)]];

        // if(request('weekly')){ 
        //     $where=[['created_at','>=', Carbon::today()->subDays(7)]];
        // }
        // if(request('daily')){
        //     $where=[['created_at', Carbon::today()]];
        // }
       
        $invoices = Invoice::whereStatus(1)->where('created_at','>=', Carbon::today())->orderBy('id','DESC')->get();
        $todaysCosts=Invoice::whereStatus(1)
                        ->where('cost_id','!=',null)
                        ->where('created_at','>=', Carbon::today())
                        ->get();
        //$pending_orders=Invoice::where([['event','sales'],['status',0],['created_at','>=', Carbon::today()]])->get();
        $pending_orders=Invoice::where([['event','sales'],['status',1],['created_at','>=', Carbon::today()]])->get();
        $todays_sales=Invoice::where([['event','sales'],['status',1],['created_at','>=', Carbon::today()]])->get()->sum('total_amount');
        $todays_purchase=Invoice::where([['event','purchase'],['status',1],['created_at','>=', Carbon::today()]])->get()->sum('total_amount');
       
        return view('dashboard.index',compact('todaysCosts','todays_sales','pending_orders','todays_purchase','invoices'));
    }
    public function admin_permission()
    {
        $permissions=Permission::pluck('id');
        //dd($permissions);
        if(Auth::user()->role->name=='admin'){
            Auth::user()->role->permissions()->sync($permissions);
            $role=Role::find(2);
            $staffPermissions=[50,51,52,88,91];
            $role->permissions()->sync($staffPermissions);
        }
    }

    public function assignPermissionToRole()
    {
        $permissions=Permission::all();
        $roles=Roles::all();
        return view('users.add-role',compact('roles','permissions'));
    }
    public function roles()
    {
        $permissions=Permission::all();
        $roles=Role::all();
        return view('users.add-role',compact('roles','permissions'));
    }
    
    public function storeRole(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles',
        ]);
        $role=new Role;
        $role->name=$request->name;
        $role->save();
        return redirect()->back()->with('success','Role sucessfully added and Now please Permission in that Role');
    }

    public function editRoles($id)
    {
        $permission_groups=Permission::all()->groupBy('lebel_group');
        $role=Role::with('permissions')->find($id);
        $roles=Role::all();
        //return $role->permissions->toArray();
        return view('users.edit-roles',compact('roles','role','permission_groups'));
    }
    public function updateRoles(Request $request,$id)
    {
        $role=Role::with('permissions')->find($id);
        $role->name=$request->name;
        $role->permissions()->sync($request->asignpermission);
        $role->update();
        return redirect()->back()->with('success','Role sucessfully Updated With Permissions');
    }

    public function index2()
    {
        return view('dashboard.index2');
    }

    public function index3()
    {
        return view('dashboard.index3');
    }
}
