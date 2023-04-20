<?php

namespace Database\Seeders;

use App\Models\State;
use App\Models\Region;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RegionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvData = fopen(base_path('database/csv/regions.csv'), 'r');
        $transRow = true;
        while (($data = fgetcsv($csvData, 555, ',')) !== false) {
            if (!$transRow) {
                Region::create([
                    'name' => $data[1] ?? 'N/A',
                    'state_id' => State::where('name->en', $data[0])->first()->id,
                ]);
            }
            $transRow = false;
        }
        fclose($csvData);
    }
}
