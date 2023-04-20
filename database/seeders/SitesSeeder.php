<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Site;
use App\Models\SiteType;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SitesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //php artisan db:seed --class=SitesSeeder
        $csvData = fopen(base_path('database/csv/sites.csv'), 'r');
        $transRow = true;
        while (($data = fgetcsv($csvData, 555, ',')) !== false) {
            if (!$transRow) {
                if (isset($data[11])) {
                    $parent_name = $data[10];
                    $type =  SiteType::with('parent')
                        ->where('name->en',$data[11])
                        ->whereHas('parent',function($query)use($parent_name){
                            $query->where('name->en',$parent_name);
                        })
                        ->first();
                    if (!is_null($type)) {
                        Site::create([
                            'city_id' => City::where('clli', $data[0])->first()->id,
                            'type_id' => $type->id,
                            'name' => $data[2],
                            'clli' => $data[1],
                            'address' => $data[3],
                            'phone_line' => $data[4],
                            'emergency_line' => $data[5],
                            'latitude' => $data[6],
                            'longitude' => $data[7],
                            'contact_and_site_access' => $data[8],
                            'other_site_information' => $data[9],
                            'manager' => $data[12],
                            'plant' => $data[13],
                        ]);
                    }
                }
            }
            $transRow = false;
        }
        fclose($csvData);
    }
}
