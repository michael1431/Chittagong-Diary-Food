<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    public function order_by(){
        return $this->belongsTo(User::class,'related_party_id');
    }
    public function sales(){
        return $this->hasMany(Sale::class,'invoice_no','invoice_no');
    }
    public function products(){
        return $this->hasMany(AccessoriesStock::class,'invoice_no','invoice_no');
    }
    public function purchase(){
        return $this->hasOne(Purchase::class,'invoice_no','invoice_no');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function customer(){
        return $this->hasOneThrough('App\Employee', 'App\User','id','user_id','related_party_id');
    }
    public function subDistributor(){
        return $this->belongsTo(SubDistributor::class,'invoice_no','invoice_no');
    }
    public function supplier(){
        return $this->belongsTo(Supplier::class,'related_party_id');
    }
    public function cost(){
        return $this->belongsTo(Cost::class,'cost_id');
    }
}
