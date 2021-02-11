<?php

namespace App\Inventory;

use Illuminate\Database\Eloquent\Model;

class InventoryItem extends Model
{
    protected $table = 'inventory_items';

    protected $fillable = ['item_code','name','description','inventory_department_id','unit_inventory_id','group_inventory_id','price'];

    public function department(){
        return $this->belongsTo(Department::class,'inventory_department_id');
    }

    public function group(){
        return $this->belongsTo(GroupInventory::class,'group_inventory_id');
    }

    public function unit(){
        return $this->belongsTo(UnitInventory::class,'unit_inventory_id');
    }
}
