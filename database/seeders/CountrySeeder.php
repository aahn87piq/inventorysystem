<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Country::insert([
            ['name' => 'Iraq', 'code' => 'IQ'],
            ['name' => 'Jordan', 'code' => 'JO'],
            ['name' => 'United Arab Emirates', 'code' => 'AE'],
        ]);
    }
}
