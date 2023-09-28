<?php

namespace Database\Seeders;

use App\Models\AlarmCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AlarmCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvData = fopen(base_path('database/csv/alarmCategories.csv'), 'r');
        $transRow = true;
        while (($data = fgetcsv($csvData, 555, ',')) !== false) {
            if (!$transRow) {

                AlarmCategory::create([
                    'label' => $data[0],
                    'description' => $data[1]
                ]);


            }
            $transRow = false;
        }
        fclose($csvData);
    }
}
