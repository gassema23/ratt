<?php

namespace Database\Seeders;

use App\Models\GeographicType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GeographicTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvData = fopen(base_path('database/csv/geographictypes.csv'), 'r');
        $transRow = true;
        while (($data = fgetcsv($csvData, 555, ',')) !== false) {
            if (!$transRow) {
                GeographicType::create([
                    'name' => $data[0],
                ]);
            }
            $transRow = false;
        }
        fclose($csvData);
    }
}
