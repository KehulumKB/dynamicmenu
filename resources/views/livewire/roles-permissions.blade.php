<div>
    <h2>Manage Roles & Permissions</h2>

    <input type="text" wire:model="roleName">
    <button wire:click="createRole">Add Role</button>

    <select wire:model="selectedRole">
        <option value="">Select Role</option>
        @foreach($roles as $role)
            <option value="{{ $role->id }}">{{ $role->name }}</option>
        @endforeach
    </select>

    @if($selectedRole)
        <h3>Permissions for Role</h3>
        @foreach($permissions as $permission)
            <label>
                <input type="checkbox" wire:model="selectedPermissions" value="{{ $permission->name }}">
                {{ $permission->name }}
            </label>
        @endforeach
        <button wire:click="updateRolePermissions">Update</button>
    @endif
</div>
