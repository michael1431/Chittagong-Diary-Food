<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    //protected $connection = 'admin';
    public function roles(){
        return $this->belongsToMany('App\Role');
    }
}
