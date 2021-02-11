<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GoodsinProduct extends Model
{
    protected $fillable = ['invoice_no','warehouse_id', 'goodsin_id', 'requisition_id', 'quotation_id', 'purchase_id', 'product_id', 'user_id', 'supplier_id', 'qty', 'price', 'remarks','department_id','group_id'];

    public function department(){
        return $this->belongsTo(Department::class,'department_id');
    }
    public function group(){
        return $this->belongsTo(Group::class,'group_id');
    }
    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }
}
