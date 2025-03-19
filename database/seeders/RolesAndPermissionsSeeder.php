<?php

namespace Database\Seeders;

use App\Models\Menu;
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
            'view_dashboard',
            'manage_users',
            'manage_roles',
            'manage_menus',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Define roles and assign permissions
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $adminRole->syncPermissions($permissions);

        $userRole = Role::firstOrCreate(['name' => 'User']);
        $userRole->givePermissionTo('view_dashboard');

        // Create menus
        $dashboardMenu = Menu::create([
            'name' => 'Dashboard',
            'icon' => 'home',
            'route' => 'dashboard',
            'order' => 1,
            'permission' => 'view_dashboard'
        ]);

        $userMenu = Menu::create([
            'name' => 'Users',
            'icon' => 'users',
            'route' => 'users.index',
            'order' => 2,
            'permission' => 'manage_users'
        ]);

        $rolesMenu = Menu::create([
            'name' => 'Roles',
            'icon' => 'shield',
            'route' => 'roles.index',
            'order' => 3,
            'permission' => 'manage_roles'
        ]);
    }
}
