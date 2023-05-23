<?php

namespace Database\Seeders;

use App\Models\AlarmSwitchType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AlarmSwitchTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvData = fopen(base_path('database/csv/switchTypes.csv'), 'r');
        $transRow = true;
        while (($data = fgetcsv($csvData, 555, ',')) !== false) {
            if (!$transRow) {
                AlarmSwitchType::create([
                    'label' => $data[2],
                    'description' => $data[3]
                ]);
            }
            $transRow = false;
        }
        fclose($csvData);
    }
}
