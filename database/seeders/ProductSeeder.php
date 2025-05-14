<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Product::insert([
            ['name' => 'Product 1', 'sku' => 'PROD-001', 'status' => 'active', 'description' => 'Product 1', 'price' => 10.00],
            ['name' => 'Product 2', 'sku' => 'PROD-002', 'status' => 'active', 'description' => 'Product 2', 'price' => 20.00],
        ]);
    }
}
