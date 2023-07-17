<?php

namespace Database\Seeders;

use App\Models\BiriEquipment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BiriEquipmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvData = fopen(base_path('database/csv/biriEquipments.csv'), 'r');
        $transRow = true;
        while (($data = fgetcsv($csvData, 555, ',')) !== false) {
            if (!$transRow) {
                BiriEquipment::create([
                    'label' => $data[0],
                ]);
            }
            $transRow = false;
        }
        fclose($csvData);
    }
}
