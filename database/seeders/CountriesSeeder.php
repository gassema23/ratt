<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvData = fopen(base_path('database/csv/countries.csv'), 'r');
        $transRow = true;
        while (($data = fgetcsv($csvData, 555, ',')) !== false) {
            if (!$transRow) {
                Country::create([
                    'name' => $data[0],
                    'iso' => $data[1],
                    'region' => empty($data[2]) ? null : $data[2],
                    'sub_region' => empty($data[3]) ? null : $data[3],
                    'capital' => empty($data[4]) ? null : $data[4],
                    'latitude' => empty($data[5]) ? null : $data[5],
                    'longitude' => empty($data[6]) ? null : $data[6],
                ]);
            }
            $transRow = false;
        }
        fclose($csvData);
    }
}
