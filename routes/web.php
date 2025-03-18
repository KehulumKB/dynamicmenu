<?php

use App\Livewire\ManageAddresses;
use App\Livewire\ManageProjects;
use App\Livewire\ManageUsers;
use App\Livewire\ViewReports;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\RolePermissionController;
use App\Livewire\RolePermissionManager;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');

    Route::get('manage-users', ManageUsers::class)->name('manage-users');
    Route::get('manage-projects', ManageProjects::class)->name('manage-projects');
    Route::get('manage-addresses', ManageAddresses::class)->name('manage-addresses');
    Route::get('view-reports', ViewReports::class)->name('view-reports');

    // Route::middleware(['role:Admin'])->group(function () {
    //     Route::get('/admin/dashboard', function () {
    //         return 'Admin Dashboard';
    //     });
    // });

    Route::get('/manage-role-perm', RolePermissionManager::class)->name('manage.role.perm');
});

require __DIR__.'/auth.php';
