<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Inventory::insert([
            ['product_id' => 1, 'warehouse_id' => 1, 'quantity' => 50, 'minimum_quantity' => 10],
            ['product_id' => 2, 'warehouse_id' => 2, 'quantity' => 30, 'minimum_quantity' => 5],
        ]);
    }
}
