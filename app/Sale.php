<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = ['price','invoice_no', 'qty', 'note', 'order_by', 'product_id'];

    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }
}
