<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class UsersPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory()->create([
            'name' => 'Super Admin',
            'employe_id' => 'T123456',
            'email' => 'mathieu.gasse2@telus.com',
            'password' => Hash::make('password'),
        ]);
        $user->teams()->attach(3);
        $user->switchTeam(3);
        $user->assignRole(Role::findById(1)->id);
    }
}
