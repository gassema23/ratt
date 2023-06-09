<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Super Admin
        $superAdmin = Role::firstOrCreate(['name' => 'Super-Admin']);
        $superAdmin->givePermissionTo(Permission::all());
        //Admin
        $admin = Role::firstOrCreate(['name' => 'Admin']);
        $admin->givePermissionTo([
            "comments-view",
            "comments-create",
            "categories-viewAny",
            "categories-view",
            "categories-create",
            "categories-update",
            "categories-delete",
            "categories-restore",
            "categories-forceDelete",
            "documentations-viewAny",
            "documentations-view",
            "documentations-create",
            "documentations-update",
            "documentations-delete",
            "documentations-restore",
            "documentations-forceDelete",
            "cities-viewAny",
            "cities-view",
            "cities-create",
            "cities-update",
            "cities-delete",
            "cities-restore",
            "cities-forceDelete",
            "countries-viewAny",
            "countries-view",
            "countries-create",
            "countries-update",
            "countries-delete",
            "countries-restore",
            "countries-forceDelete",
            "regions-viewAny",
            "regions-view",
            "regions-create",
            "regions-update",
            "regions-delete",
            "regions-restore",
            "regions-forceDelete",
            "sites-viewAny",
            "sites-view",
            "sites-create",
            "sites-update",
            "sites-delete",
            "sites-restore",
            "sites-forceDelete",
            "states-viewAny",
            "states-view",
            "states-create",
            "states-update",
            "states-delete",
            "states-restore",
            "states-forceDelete",
            "networks-viewAny",
            "networks-view",
            "networks-create",
            "networks-update",
            "networks-delete",
            "networks-restore",
            "networks-forceDelete",
            "networks-attachFiles",
            "networks-assignScenarios",
            "networks-changeStatusTasks",
            "networks-historyTask",
            "networks-networksSections",
            "networks-taskSection",
            "networks-networkTimeline",
            "networks-viewScenarios",
            "projects-viewAny",
            "projects-view",
            "projects-create",
            "projects-update",
            "projects-delete",
            "projects-restore",
            "projects-forceDelete",
            "scenarios-viewAny",
            "scenarios-view",
            "scenarios-create",
            "scenarios-update",
            "scenarios-delete",
            "scenarios-restore",
            "scenarios-forceDelete",
            "tasks-viewAny",
            "tasks-view",
            "tasks-create",
            "tasks-update",
            "tasks-delete",
            "tasks-restore",
            "tasks-forceDelete",
            "geographicType-viewAny",
            "geographicType-view",
            "geographicType-create",
            "geographicType-update",
            "geographicType-delete",
            "geographicType-restore",
            "geographicType-forceDelete",
            "siteTypes-viewAny",
            "siteTypes-view",
            "siteTypes-create",
            "siteTypes-update",
            "siteTypes-delete",
            "siteTypes-restore",
            "siteTypes-forceDelete",
            "teams-viewAny",
            "teams-view",
            "teams-create",
            "teams-update",
            "teams-delete",
            "teams-restore",
            "teams-forceDelete",
            "users-viewAny",
            "users-view",
            "users-create",
            "users-update",
            "users-delete",
            "users-restore",
            "users-forceDelete",
        ]);

        // Manager
        $manager = Role::firstOrCreate(['name' => 'Manager']);
        $manager->givePermissionTo([
            "comments-view",
            "comments-create",
            "categories-viewAny",
            "categories-view",
            "categories-create",
            "categories-update",
            "categories-delete",
            "categories-restore",
            "documentations-viewAny",
            "documentations-view",
            "documentations-create",
            "documentations-update",
            "documentations-delete",
            "documentations-restore",
            "documentations-forceDelete",
            "cities-viewAny",
            "cities-view",
            "cities-create",
            "cities-update",
            "countries-viewAny",
            "countries-view",
            "countries-create",
            "countries-update",
            "regions-viewAny",
            "regions-view",
            "regions-create",
            "regions-update",
            "sites-viewAny",
            "sites-view",
            "sites-create",
            "sites-update",
            "states-viewAny",
            "states-view",
            "states-create",
            "states-update",
            "networks-viewAny",
            "networks-view",
            "networks-create",
            "networks-update",
            "networks-delete",
            "networks-attachFiles",
            "networks-assignScenarios",
            "networks-changeStatusTasks",
            "networks-historyTask",
            "networks-networksSections",
            "networks-taskSection",
            "networks-networkTimeline",
            "networks-viewScenarios",
            "projects-viewAny",
            "projects-view",
            "projects-create",
            "projects-update",
            "projects-delete",
            "scenarios-viewAny",
            "scenarios-view",
            "scenarios-create",
            "scenarios-update",
            "tasks-viewAny",
            "tasks-view",
            "tasks-create",
            "tasks-update",
            "teams-viewAny",
            "teams-view",
            "users-viewAny",
            "users-view",
            "users-create",
            "users-update",
            "users-delete",
            "users-restore",
        ]);
        // Technicien
        $technicien = Role::firstOrCreate(['name' => 'Technician']);
        $technicien->givePermissionTo([
            "comments-view",
            "comments-create",
            "documentations-viewAny",
            "documentations-view",
            "documentations-forceDelete",
            "cities-viewAny",
            "cities-view",
            "countries-viewAny",
            "countries-view",
            "regions-viewAny",
            "regions-view",
            "sites-viewAny",
            "sites-view",
            "states-viewAny",
            "states-view",
            "networks-viewAny",
            "networks-view",
            "networks-attachFiles",
            "networks-changeStatusTasks",
            "networks-historyTask",
            "networks-networksSections",
            "networks-taskSection",
            "networks-networkTimeline",
            "networks-viewScenarios",
            "projects-viewAny",
            "projects-view",
            "teams-viewAny",
            "teams-view",
            "users-viewAny",
            "users-view",
        ]);

        // Guest
        $technicien = Role::firstOrCreate(['name' => 'Guest']);
        $technicien->givePermissionTo([
            "comments-view",
            "comments-create",
            "networks-viewAny",
            "networks-view",
            "networks-attachFiles",
            "networks-historyTask",
            "networks-networksSections",
            "networks-taskSection",
            "networks-networkTimeline",
            "networks-viewScenarios",
            "projects-viewAny",
            "projects-view",
            "teams-viewAny",
            "teams-view",
            "users-viewAny",
            "users-view",
        ]);
    }
}
