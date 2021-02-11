<?php

namespace App\Inventory;

use App\InvoiceQuotation;
use App\QuotationProduct;
use Illuminate\Database\Eloquent\Model;

class Requisition extends Model
{
    protected $fillable = [ 'price', 'qty', 'note', 'invoice_requisition_id', 'user_id', 'inventory_item_id','checking_note'];

    public function product(){
        return $this->belongsTo(InventoryItem::class,'inventory_item_id');
    }

    public function invoice(){
        return $this->belongsTo(InvoiceRequisition::class,'invoice_requisition_id');
    }

    public function quotationProducts(){
        return $this->hasMany(QuotationProduct::class);
    }


}
