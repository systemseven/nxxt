<?php

use App\Models\User;
use Spatie\Permission\Models\Role;

test('user role pages require permission', function ($route) {
    $role = Role::create(['name' => str()->random(10)]);
    $user = User::factory()->create()->assignRole($role);
    $to = str($route)->contains('.edit') ? route($route, $role) : route($route);
    $this->actingAs($user)->get($to)->assertForbidden();
})->with([
    'roles.index',
    'roles.create',
    'roles.edit',
]);

test('user role pages can be accessed', function ($route, $permission) {
    $user = userWithPermission($permission);
    $role = Role::create(['name' => str()->random(10)]);
    $to = str($route)->contains('.edit') ? route($route, $role) : route($route);
    $this->actingAs($user)->get($to)->assertOk();
})->with([
    ['roles.index', 'view:user_roles'],
    ['roles.create', 'create:user_roles'],
    ['roles.edit', 'edit:user_roles'],
]);

test('super admin can access user role pages', function ($route) {
    $user = User::factory()->create()->assignRole('super_admin');
    $role = Role::create(['name' => str()->random(10)]);
    $to = str($route)->contains('.edit') ? route($route, $role) : route($route);
    $this->actingAs($user)->get($to)->assertOk();
})->with([
    'roles.index',
    'roles.create',
    'roles.edit',
]);
