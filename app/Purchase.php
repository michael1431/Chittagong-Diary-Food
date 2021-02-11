<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = ['requisition_id','invoice_no','quotation_id','user_id','note'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function quotation(){
        return $this->belongsTo(Quotation::class);
    }

    public function requisition(){
        return $this->belongsTo(Requisition::class);
    }
    public function invoice(){
        return $this->belongsTo(Invoice::class,'invoice_no','invoice_no');
    }

}
