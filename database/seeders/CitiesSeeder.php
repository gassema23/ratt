<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Region;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvData = fopen(base_path('database/csv/cities.csv'), 'r');
        $transRow = true;
        while (($data = fgetcsv($csvData, 555, ',')) !== false) {
            if (!$transRow) {
                $state_name = $data[0];
                $region = Region::where('name->en', $data[1])->whereHas('state', function ($query) use ($state_name) {
                    $query->where('name->en', $state_name);
                })->first()->id;
                City::create([
                    'name' => $data[2],
                    'region_id' => $region,
                    'clli' => $data[5],
                    'latitude' => $data[3],
                    'longitude' => $data[4],
                ]);
            }
            $transRow = false;
        }
        fclose($csvData);
    }
}
