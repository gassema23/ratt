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
        $csvData = fopen(base_path('database/csv/biriActivities.csv'), 'r');
        $transRow = true;
        while (($data = fgetcsv($csvData, 555, ',')) !== false) {
            if (!$transRow) {
                BiriActivity::create([
                    'technology_id' => $data[1],
                    'equipment_id' => $data[2],
                    'category_id' => $data[4],
                    'description' => $data[5],
                    'avg_single' => $data[6],
                    'ps50_plan' => $data[7],
                    'ps50_act' => $data[8],
                    'avg_actual' => $data[9]
                ]);
            }
            $transRow = false;
        }
        fclose($csvData);
    }
}
