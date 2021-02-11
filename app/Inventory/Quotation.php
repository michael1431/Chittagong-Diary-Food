<?php

namespace App\Inventory;

use App\InvoiceQuotation;
use App\QuotationProduct;
use App\User;
use App\Supplier;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    protected $fillable = ['invoice_quotation_id','requisition_id','supplier_id','user_id','price','qty','status'];

    public function requisition(){
        return $this->belongsTo(Requisition::class,'requisition_id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function invoice_quotation(){
        return $this->belongsTo(InvoiceQuotation::class);
    }

    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }

    public function quotationProduct(){
        return $this->hasMany(QuotationProduct::class);
    }
}
