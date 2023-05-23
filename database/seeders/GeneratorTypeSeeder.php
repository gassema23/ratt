<?php

namespace Database\Seeders;

use App\Models\AlarmGeneratorType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GeneratorTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvData = fopen(base_path('database/csv/generatorType.csv'), 'r');
        $transRow = true;
        while (($data = fgetcsv($csvData, 555, ',')) !== false) {
            if (!$transRow) {
                AlarmGeneratorType::create([
                    'label' => $data[0],
                    'prerequiste' => $data[1] ?? '',
                    'deployment_procedure' => $data[2] ?? '',
                    'emergency_contact' => $data[3] ?? '',
                    'generator_available' => $data[4] ?? '',
                ]);
            }
            $transRow = false;
        }
        fclose($csvData);
    }
}
