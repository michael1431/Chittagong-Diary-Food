<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class PermissionCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //dd(Auth::user()->role->permissions);
        if(Auth::check()){
            $route_name=$request->route()->getName();
            $permissions=Auth::user()->role->permissions;
            foreach($permissions as $permission){
                if($permission->name == $route_name){                   
                    return $next($request);
                }
                
            }
            if(Auth::user()->role->name=='admin'){
                return redirect('/');
            }elseif(Auth::user()->role->id==2){
                return redirect()->route('daily-log');
            }
        }
       
        // if(Auth::user() && Auth::user()->role->name=="admin"){

        //     return $next($request);
        // }
        return redirect('/');
    }
}
