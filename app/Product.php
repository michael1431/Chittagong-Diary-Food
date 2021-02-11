<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['item_code','name','description','department_id','product_unit_id','group_id','price','marketing_commission','mrp','employee_commission'];

    public function department(){
        return $this->belongsTo(Department::class,'department_id');
    }
    public function stocks(){
        return $this->hasMany(GoodsinProduct::class,'product_id');
    }
    public function accesories(){
        return $this->hasMany(AccessoriesStock::class,'product_id');
    }

    public function group(){
        return $this->belongsTo(Group::class,'group_id');
    }

    public function unit(){
        return $this->belongsTo(ProductUnit::class,'product_unit_id');
    }
}
