<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    protected $fillable = ['requisition_id', 'supplier_id','user_id', 'price', 'qty', 'status'];

    public function quotationProduct(){
        return $this->hasMany(QuotationProduct::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }


}
