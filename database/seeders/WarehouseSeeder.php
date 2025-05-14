<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Warehouse::insert([
            ['name' => 'Erbil Warehouse', 'location' => 'Erbil', 'country_id' => 1],
            ['name' => 'Ammar Warehouse', 'location' => 'Amman', 'country_id' => 2],
            ['name' => 'Dubai Warehouse', 'location' => 'Dubai', 'country_id' => 3],
        ]);
    }
}
