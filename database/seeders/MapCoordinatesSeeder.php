<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MapCoordinatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('bike_pick_locations')->insert([
              [
                'name' => 'Port Blair',
                'location' => 'South Andaman',
                'latitude' => 11.65133066,
                'longitude' => 92.73255988,
                'pick_location' => 'Andaman Bliss - Best DMC & B2B Supplier for Andaman Tour Packages',
                'range_km' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Havelock Island',
                'location' => 'Havelock Island',
                'latitude' => 12.04153393,
                'longitude' => 92.98245105,
                'pick_location' => 'Haveloc Jetty',
                'range_km' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Neil Island',
                'location' => 'Neil Island',
                'latitude' => 11.83639746,
                'longitude' => 93.03081709,
                'pick_location' => 'Neil Jetty',
                'range_km' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
