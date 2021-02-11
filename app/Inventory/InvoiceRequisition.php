<?php

namespace App\Inventory;

use App\InvoiceQuotation;
use App\User;
use Illuminate\Database\Eloquent\Model;

class InvoiceRequisition extends Model
{
    protected $fillable = ['invoice_no', 'qty', 'price', 'note', 'custom_date', 'user_id','status'];

    public function requisitions(){
        return $this->hasMany(Requisition::class,'invoice_requisition_id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function quotations(){
        return $this->hasMany(InvoiceQuotation::class);
    }


}
