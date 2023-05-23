<?php

namespace Database\Seeders;

use App\Models\AlarmSpecification;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AlarmSpecificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvData = fopen(base_path('database/csv/alarmSpecification.csv'), 'r');
        $transRow = true;
        while (($data = fgetcsv($csvData, 555, ',')) !== false) {
            if (!$transRow) {
                AlarmSpecification::create([
                    'label' => $data[2],
                    'description' => $data[3]
                ]);
            }
            $transRow = false;
        }
        fclose($csvData);
    }
}
