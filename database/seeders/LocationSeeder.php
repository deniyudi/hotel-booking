<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // setelah bikin factory bikin seeder untuk buat city dan country , ini dari factory
        City::factory()->count(100)->create();
        Country::factory()->count(100)->create();
    }
}
