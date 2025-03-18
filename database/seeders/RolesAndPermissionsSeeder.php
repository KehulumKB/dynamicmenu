<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Define permissions
        $permissions = [
            'manage-users',
            'manage-projects',
            'view-reports',
            'manage-addresses',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles and assign permissions
        $admin = Role::firstOrCreate(['name' => 'Admin']);
        $manager = Role::firstOrCreate(['name' => 'Manager']);
        $user = Role::firstOrCreate(['name' => 'User']);

        // Assign permissions to roles
        $admin->givePermissionTo(['manage-users', 'manage-projects', 'view-reports', 'manage-addresses']);
        $manager->givePermissionTo(['manage-projects', 'view-reports']);
        $user->givePermissionTo(['view-reports']);
    }
}
