<?php

namespace App\Inventory;

use Illuminate\Database\Eloquent\Model;

class UnitInventory extends Model
{
    protected $table = 'unit_inventories';
    protected $fillable = ['name','description'];
}
