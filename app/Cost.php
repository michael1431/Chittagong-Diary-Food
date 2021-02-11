<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cost extends Model
{
    protected $fillable = ['name','description'];

    public function lcs(){
        return $this->belongsToMany(Goodsin::class,'cost_id');
    }
}
