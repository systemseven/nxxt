<?php

use App\Livewire\Roles\RoleCreate;
use App\Livewire\Roles\RoleList;
use App\Livewire\Roles\RoleUpdate;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Users\UserCreate;
use App\Livewire\Users\UserList;
use Illuminate\Support\Facades\Route;

if (! app()->environment('production')) {
    Route::get('/notification', function () {
        $user = \App\Models\User::first();

        return (new \App\Notifications\UserAccountCreated($user))
            ->toMail($user);
    });
}

Route::redirect('/', 'dashboard')->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('set-password/{user}', function () {
    dd('#todo');
})->name('auth.set-password');

// /https://spatie.be/docs/laravel-permission/v6/basic-usage/middleware
Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');
    Route::get('settings/profile', Profile::class)->name('profile.edit');
    Route::get('settings/password', Password::class)->name('user-password.edit');
    //    Route::get('settings/appearance', Appearance::class)->name('appearance.edit');

    Route::prefix('settings')->group(function () {
        Route::get('users', UserList::class)->middleware(['role_or_permission:super_admin|view:users'])->name('users.index');
        Route::get('users/create', UserCreate::class)->middleware(['role_or_permission:super_admin|create:users'])->name('users.create');

        Route::get('roles', RoleList::class)->middleware(['role_or_permission:super_admin|view:user_roles'])->name('roles.index');
        Route::get('roles/create', RoleCreate::class)->middleware(['role_or_permission:super_admin|create:user_roles'])->name('roles.create');
        Route::get('roles/{role}/edit', RoleUpdate::class)->middleware(['role_or_permission:super_admin|edit:user_roles'])->name('roles.edit');
    });

});

// note I can do a middleware of: 'password.confirm' to require a password confirmation
