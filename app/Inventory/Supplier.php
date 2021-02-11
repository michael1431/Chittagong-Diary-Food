<?php

namespace App\Inventory;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'suppliers';

    protected $fillable = ['name','phone','email','address'];
}
