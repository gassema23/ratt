<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\PermissionRegistrar;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = collect(Role::all());
        $team = collect(Team::all()->modelKeys());
        $users =  User::factory(50)->create();
        foreach ($users as $user) {
            $user->assignRole($role->random());
            $m_team = $team->random();
            $user->teams()->attach($m_team);
            $user->switchTeam($m_team);
        }
    }
}
