<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = ['name','user_id','image','father','mother','wife','nid','phone1','phone2','address','salary'];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
