<?php

namespace Database\Seeders;

use App\Helper\HungarianCountiesAndCities;
use Illuminate\Database\Seeder;
use App\Models\County;

class CountiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (array_keys(HungarianCountiesAndCities::$countyAndCityData) as $countyName){
            County::firstOrCreate(
                ['name' => $countyName],
                ['badge' => HungarianCountiesAndCities::$countyAndCityData[$countyName]['image']]
            );
        }
    }
}
