<?php

namespace App\Inventory;

use App\Product;
use Illuminate\Database\Eloquent\Model;

class TempData extends Model
{
    protected $fillable = ['product_id', 'user_id', 'qty', 'price', 'note', 'type'];

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
