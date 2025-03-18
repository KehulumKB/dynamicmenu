<?php

namespace App\Livewire;

use Exception;
use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionManager extends Component
{
    public $roles, $permissions, $selectedRole, $selectedPermissions = [];

    public function mount()
    {
        $this->roles = Role::all();
        $this->permissions = Permission::all();
    }

    public function updatedSelectedRole($roleId)
    {
        $role = Role::find($roleId);
        $this->selectedPermissions = $role ? $role->permissions->pluck('id')->toArray() : [];
    }

    // public function updatePermissions()
    // {
    //     if (!$this->selectedRole) {
    //         session()->flash('error', 'Please select a role.');
    //         return;
    //     }

    //     $role = Role::find($this->selectedRole);
    //     if ($role) {
    //         // Convert permission IDs to names
    //         $permissions = Permission::whereIn('id', $this->selectedPermissions)->pluck('name')->toArray();

    //         $role->syncPermissions($permissions); // Sync using permission names

    //         session()->flash('message', 'Permissions updated successfully.');
    //     }
    // }

    // public function updatePermissions()
    // {
    //     if (!$this->selectedUser) {
    //         session()->flash('error', 'Please select a user.');
    //         return;
    //     }

    //     $user = User::find($this->selectedUser);

    //     if ($user) {
    //         // Convert selected permission IDs to permission names
    //         $permissions = Permission::whereIn('id', $this->selectedPermissions)->pluck('name')->toArray();

    //         // Assign permissions directly to the user
    //         $user->syncPermissions($permissions);

    //         // Assign roles to the user (if any selected)
    //         if (!empty($this->selectedRoles)) {
    //             $roles = Role::whereIn('id', $this->selectedRoles)->pluck('name')->toArray();
    //             $user->syncRoles($roles); // Sync roles dynamically
    //         }

    //         session()->flash('message', 'User roles and permissions updated successfully.');
    //     }
    // }

    public function updateRolePermissions()
    {
        // Validate that a role is selected
        if (!$this->selectedRole) {
            session()->flash('error', 'Please select a role.');
            return;
        }

        // Find the selected role
        $role = Role::find($this->selectedRole);

        if ($role) {
            // Convert the selected permission IDs to permission names
            $permissions = Permission::whereIn('id', $this->selectedPermissions)->pluck('name')->toArray();

            // Sync permissions for the role
            $role->syncPermissions($permissions);  // This will only modify the role's permissions

            // Flash success message
            session()->flash('message', 'Role permissions updated successfully.');
        } else {
            session()->flash('error', 'Role not found.');
        }
    }

    
    public function render()
    {
        return view('livewire.role-permission-manager');
    }
}
