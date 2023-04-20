<?php

namespace Database\Seeders;

use App\Models\SiteType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiteTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvData = fopen(base_path('database/csv/siteTypes.csv'), 'r');
        $transRow = true;
        while (($data = fgetcsv($csvData, 555, ',')) !== false) {
            if (!$transRow) {
                $parent_id = null;
                if(!empty($data[1])){
                    $parent_id = SiteType::where('name->en',$data[1])->first()->id;
                }
                SiteType::create([
                    'name' => $data[0],
                    'parent_id' => $parent_id,
                ]);
            }
            $transRow = false;
        }
        fclose($csvData);
    }
}
