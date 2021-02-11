<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requisition extends Model
{
    protected $fillable = ['invoice_no', 'qty', 'price', 'note', 'custom_date','check_user_id', 'user_id', 'unit_id'];

    public function RequisitonProducts(){
        return $this->hasMany(RequisitionProduct::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function checkedBy(){
        return $this->belongsTo(User::class,'check_user_id');
    }
}
