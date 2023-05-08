<?php

namespace Database\Seeders;

use App\Models\BiriActivity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BiriActivitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvData = fopen(base_path('database/csv/activities.csv'), 'r');
        $transRow = true;
        while (($data = fgetcsv($csvData, 555, ',')) !== false) {
            if (!$transRow) {
                BiriActivity::create([
                    'technology_name' => $data[1],
                    'equipment_name' => $data[2],
                    'activity_name' => $data[3],
                    'activity_description' => $data[4],
                    'average' => empty($data[5]) ? 0 : $data[5],
                    'ps50_plan' => empty($data[6]) ? 0 : $data[6],
                    'ps50_activity' => empty($data[7]) ? 0 : $data[7],
                    'average_actual' => empty($data[8]) ? 0 : $data[8],
                ]);
            }
            $transRow = false;
        }
        fclose($csvData);
    }
}
