<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Supplier::insert([
            ['name' => 'Supplier 1', 'contact_info' => 'mail@domain.com', 'address' => 'Dubai'],
            ['name' => 'Supplier 2', 'contact_info' => 'main@domain2.com', 'address' => 'Abu Dhabi'],
        ]);
    }
}
