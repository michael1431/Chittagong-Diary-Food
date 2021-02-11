<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubDistributor extends Model
{
    protected $fillable = ['name','invoice_no', 'user_id', 'phone', 'address'];
}
