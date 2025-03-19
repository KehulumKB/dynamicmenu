<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class AssignRole extends Component
{
    public $users, $roles, $selectedUser, $selectedRole;

    public function mount()
    {
        $this->users = User::all();
        $this->roles = Role::all();
    }

    public function assignRole()
    {
        $user = User::findOrFail($this->selectedUser);
        $user->syncRoles([$this->selectedRole]);
    }

    public function render()
    {
        return view('livewire.assign-role');
    }
}
