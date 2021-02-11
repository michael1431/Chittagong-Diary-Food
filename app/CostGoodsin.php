<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CostGoodsin extends Model
{
    protected $table = 'cost_goodsin';
    protected $fillable = ['cost_id','goodsin_id','amount','note'];

    public function cost(){
        return $this->belongsTo(Cost::class,'cost_id');
    }

    public function lc(){
        return $this->belongsTo(Goodsin::class,'goodsin_id');
    }
}
