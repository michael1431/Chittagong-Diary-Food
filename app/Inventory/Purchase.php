<?php

namespace App\Inventory;

use App\InvoiceQuotation;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = ['invoice_quotation_id','user_id','note'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function quotation(){
        return $this->belongsTo(InvoiceQuotation::class,'invoice_quotation_id');
    }

}
