<div>
    <h2>Manage Role Permissions</h2>

    <select wire:model.lazy="selectedRole">
        <option value="">Select Role</option>
        @foreach($roles as $role)
            <option value="{{ $role->id }}">{{ ucfirst($role->name) }}</option>
        @endforeach
    </select>

    <select wire:model.lazy="selectedUser">
        <option value="">Select User</option>
        @foreach($users as $user)
            <option value="{{ $user->id }}">{{ ucfirst($user->name) }}</option>
        @endforeach
    </select>


    @if($selectedUser)
        <h3>Permissions:</h3>
        @foreach($permissions as $permission)
            <label>
                <input type="checkbox" wire:model="selectedPermissions" value="{{ $permission->id }}">
                {{ ucfirst($permission->name) }}
            </label>
        @endforeach


        {{-- @foreach ($roles as $role)
            <input type="checkbox" wire:model="selectedRoles" value="{{ $role->id }}">
            <label>{{ $role->name }}</label>
        @endforeach --}}


        <button wire:click="updatePermissions">Update</button>
    @endif

    @if(session()->has('message'))
        <p>{{ session('message') }}</p>
    @endif
</div>
