<?php

namespace App\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesPermissions extends Component
{
    public $roles, $permissions, $roleName, $selectedRole, $selectedPermissions = [];

    public function mount()
    {
        $this->roles = Role::all();
        $this->permissions = Permission::all();
    }

    public function createRole()
    {
        $role = Role::create(['name' => $this->roleName]);
        $this->roles = Role::all();
        $this->roleName = '';
    }

    public function updateRolePermissions()
    {
        $role = Role::findOrFail($this->selectedRole);
        $role->syncPermissions($this->selectedPermissions);
    }

    public function render()
    {
        return view('livewire.roles-permissions', [
            'roles' => $this->roles,
            'permissions' => $this->permissions,
        ]);
    }
}
