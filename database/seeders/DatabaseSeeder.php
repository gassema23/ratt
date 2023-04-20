<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            GeographicTypesSeeder::class,
            SiteTypesSeeder::class,
            CountriesSeeder::class,
            StatesSeeder::class,
            RegionsSeeder::class,
            CitiesSeeder::class,
            SitesSeeder::class,
            TeamsSeeder::class,
            RoleSeeder::class,
            UsersPermissionsSeeder::class
        ]);
    }
}
