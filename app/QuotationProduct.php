<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuotationProduct extends Model
{
    protected $table = 'quotation_products';
    protected $fillable = ['quotation_id','requisition_id' ,'user_id', 'requisition_product_id', 'supplier_id', 'price', 'qty', 'status','note'];

    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }

    public function requisition(){
        return $this->belongsTo(Requisition::class);
    }

    public function quotation(){
        return $this->belongsTo(Quotation::class);
    }

    public function requisitionProduct(){
        return $this->belongsTo(RequisitionProduct::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
