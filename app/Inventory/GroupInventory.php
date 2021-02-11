<?php

namespace App\Inventory;

use Illuminate\Database\Eloquent\Model;

class GroupInventory extends Model
{
    protected $table = 'group_inventories';
    protected $fillable = ['name','description'];
}
