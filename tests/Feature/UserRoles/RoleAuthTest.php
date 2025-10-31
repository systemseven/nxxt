<?php

use App\Models\User;
use Spatie\Permission\Models\Role;

test('user role pages require permission', function ($route) {
    $role = Role::create(['name' => str()->random(10)]);
    $user = User::factory()->create()->assignRole($role);
    $this->actingAs($user)->get(route($route))->assertForbidden();
})->with([
    'roles.index',
    'roles.create',
]);

test('user role pages can be accessed', function ($route, $permission) {
    $user = userWithPermission($permission);
    $this->actingAs($user)->get(route($route))->assertOk();
})->with([
    ['roles.index', 'view:user_roles'],
    ['roles.create', 'create:user_roles'],
]);

test('super admin can access user role pages', function ($route) {
    $user = User::factory()->create()->assignRole('super_admin');
    $this->actingAs($user)->get(route($route))->assertOk();
})->with([
    'roles.index',
    'roles.create',
]);
