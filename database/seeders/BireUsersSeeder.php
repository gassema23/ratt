<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Support\Facades\Hash;
class BireUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pm = User::factory()->create([
            'name' => 'Technician BIRE',
            'employe_id' => 'T11111',
            'email' => 'bire@telus.com',
            'password' => Hash::make('password'),
        ]);
        $pm->teams()->attach(2);
        $pm->switchTeam(2);
        $pm->assignRole('Technician');
    }
}
