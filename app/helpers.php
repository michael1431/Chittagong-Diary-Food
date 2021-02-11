<?php
use App\CompanyInformation;
use App\Role;

function isActive($path, $active = 'active menu-open'){
    return call_user_func_array('Request::is', (array)$path) ? $active : '';
}

function company_info(){
    return CompanyInformation::latest()->first();
}
function damage_product_id(){
    return 17;
}
function hasPermission($role,$permission){
    $activeRole=Role::with('permissions')->find($role);
    foreach($activeRole->permissions as $activePermission){
        if($activePermission->name==$permission){
            return true;
        }
    }
    return false;
    //dd($permissions);
}
