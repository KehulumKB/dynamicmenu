<div>
    <h2>Assign Role to User</h2>

    <select wire:model="selectedUser">
        <option value="">Select User</option>
        @foreach($users as $user)
            <option value="{{ $user->id }}">{{ $user->name }}</option>
        @endforeach
    </select>

    <select wire:model="selectedRole">
        <option value="">Select Role</option>
        @foreach($roles as $role)
            <option value="{{ $role->name }}">{{ $role->name }}</option>
        @endforeach
    </select>

    <button wire:click="assignRole">Assign Role</button>
</div>
