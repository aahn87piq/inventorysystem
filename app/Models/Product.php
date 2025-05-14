<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'sku', 'status', 'description', 'price'];

    public function inventories()
    {
        return $this->hasMany(Inventory::class);
    }
}
