<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goodsin extends Model
{
    protected $fillable = [ 'date', 'lc', 'chalan', 'chalan_date', 'purchase_id', 'quotation_id', 'requisition_id', 'user_id', 'note', 'condition'];

    public function costs(){
        return $this->hasMany(CostGoodsin::class,'goodsin_id');
    }

    public function requisition(){
        return $this->belongsTo(Requisition::class);
    }


}
