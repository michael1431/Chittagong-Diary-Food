<?php

namespace App\Inventory;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'inventory_departments';
    protected $fillable = ['name','description'];
}
