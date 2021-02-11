<?php

namespace App;

use App\Inventory\InvoiceRequisition;
use App\Inventory\Quotation;
use App\Inventory\Supplier;
use Illuminate\Database\Eloquent\Model;

class InvoiceQuotation extends Model
{
    protected $table = 'invoice_quotations';
    protected $fillable = ['invoice_requisition_id', 'supplier_id', 'price', 'qty', 'status'];

    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }

    public function invoice_requisition(){
        return $this->belongsTo(InvoiceRequisition::class,'invoice_requisition_id');
    }

    public function quotations(){
        return $this->hasMany(Quotation::class,'invoice_quotation_id');
    }

}
