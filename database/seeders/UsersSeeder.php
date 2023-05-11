<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::factory()->create([
            'name' => 'Role Admin',
            'employe_id' => 'T111111',
            'email' => 'admin@telus.com',
            'password' => Hash::make('password'),
        ]);
        $admin->teams()->attach(3);
        $admin->switchTeam(3);
        $admin->assignRole('Admin');

        $planner = User::factory()->create([
            'name' => 'Manager Planner',
            'employe_id' => 'T111112',
            'email' => 'planner@telus.com',
            'password' => Hash::make('password'),
        ]);
        $planner->teams()->attach(5);
        $planner->switchTeam(5);
        $planner->assignRole('Manager');

        $pm = User::factory()->create([
            'name' => 'Technician PM',
            'employe_id' => 'T111113',
            'email' => 'pm@telus.com',
            'password' => Hash::make('password'),
        ]);
        $pm->teams()->attach(4);
        $pm->switchTeam(4);
        $pm->assignRole('Guest');

        $tech = User::factory()->create([
            'name' => 'Technician BIRI',
            'employe_id' => 'T111114',
            'email' => 't.biri@telus.com',
            'password' => Hash::make('password'),
        ]);
        $tech->teams()->attach(3);
        $tech->switchTeam(3);
        $tech->assignRole('Technician');
    }
}
