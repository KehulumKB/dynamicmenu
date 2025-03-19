<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800">
        <flux:sidebar sticky stashable class="border-r border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
            <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

            <a href="{{ route('dashboard') }}" class="mr-5 flex items-center space-x-2" wire:navigate>
                <x-app-logo />
            </a>

            <flux:navlist variant="outline">
                <flux:navlist.group :heading="__('Platform')" class="grid">
                    <flux:navlist.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>{{ __('Dashboard') }}</flux:navlist.item>
                </flux:navlist.group>
            </flux:navlist>

            <flux:navlist variant="outline">
                <flux:navlist.group :heading="__('')" class="grid">
                    <flux:navlist.item icon="home" :href="route('manage.role.perm')" :current="request()->routeIs('manage.role.perm')" wire:navigate>{{ __('Manage Permissions') }}</flux:navlist.item>
                </flux:navlist.group>
            </flux:navlist>

            <flux:spacer />

            {{-- <flux:navlist.group class="grid">
                @can('manage-projects')
                <flux:navlist.item icon="building-office-2" :href="route('manage-projects')">
                    {{ __('Manage Projects') }}
                </flux:navlist.item>
                @endcan

                @can('manage-users')
                <flux:navlist.item icon="users" :href="route('manage-users')">
                    {{ __('Manage Users') }}
                </flux:navlist.item>
                @endcan

                @can('view-reports')
                <flux:navlist.item icon="chart-bar" :href="route('view-reports')">
                    {{ __('View Reports') }}
                </flux:navlist.item>
                @endcan

                @can('manage-addresses')
                <flux:navlist.item icon="chart-bar" :href="route('manage-addresses')" wire:navigate>
                    {{ __('Mabage Addresses') }}
                </flux:navlist.item>
                @endcan

            </flux:navlist.group> --}}
{{--
            <ul>
                @foreach(auth()->user()->getPermissionsViaRoles() as $permission)
                <li><a href="{{ route($permission->name) }}">{{ ucfirst($permission->name) }}</a></li>
                @endforeach

                @foreach(auth()->user()->getRoleNames() as $role)
                    <li><a href="{{ route('dashboard') }}">{{ ucfirst($role) }} Dashboard</a></li>
                @endforeach
            </ul> --}}

            @php
            $permissions = auth()->user()->getAllPermissions(); // Get user's assigned permissions
            @endphp

            @foreach($permissions as $permission)
                <li>
                    <a href="{{ route($permission->name) }}">
                        {{ ucfirst($permission->name) }}
                    </a>
                </li>
            @endforeach

            {{-- @php
            $role = auth()->user()->roles->first(); // Get the first role of the user
            @endphp

            @if($role)
                <li>
                    <strong>Role: {{ ucfirst($role->name) }}</strong>
                </li>

                @foreach($role->permissions as $permission)
                    <li>
                        <a href="{{ route($permission->name) }}">
                            {{ ucfirst($permission->name) }}
                        </a>
                    </li>
                @endforeach
            @endif --}}



         <flux:spacer />

            <!-- Desktop User Menu -->
            <flux:dropdown position="bottom" align="start">
                <flux:profile
                    :name="auth()->user()->name"
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevrons-up-down"
                />

                <flux:menu class="w-[220px]">
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-left text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                    >
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>

                                <div class="grid flex-1 text-left text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:sidebar>

        <!-- Mobile User Menu -->
        <flux:header class="lg:hidden">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

            <flux:spacer />

            <flux:dropdown position="top" align="end">
                <flux:profile
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevron-down"
                />

                <flux:menu>
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-left text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                    >
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>

                                <div class="grid flex-1 text-left text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:header>

        {{ $slot }}

        @fluxScripts
    </body>
</html>
