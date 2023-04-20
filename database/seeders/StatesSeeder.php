<?php

namespace Database\Seeders;

use App\Models\State;
use App\Models\Country;
use App\Models\GeographicType;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvData = fopen(base_path('database/csv/states.csv'), 'r');
        $transRow = true;
        while (($data = fgetcsv($csvData, 555, ',')) !== false) {
            if (!$transRow) {
                State::create([
                    'name' => $data[2],
                    'country_id' => Country::where('name->en', $data[0])->first()->id,
                    'abbr' => empty($data[3]) ? null : $data[3],
                    'type_id' => GeographicType::where('name->en', $data[1])->first()->id,
                    'latitude' => empty($data[4]) ? null : $data[4],
                    'longitude' => empty($data[5]) ? null : $data[5],
                ]);
            }
            $transRow = false;
        }
        fclose($csvData);
    }
}
