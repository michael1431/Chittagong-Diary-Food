<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequisitionProduct extends Model
{
    protected $fillable = ['price', 'qty', 'note', 'requisition_id', 'user_id', 'product_id'];

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
