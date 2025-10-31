<?php

use App\Models\User;

test('user pages require permission', function ($route) {
    $user = User::factory()->create();
    $to = str($route)->contains('.edit') ? route($route, $user) : route($route);
    $this->actingAs($user)->get($to)->assertForbidden();
})->with([
    'users.index',
    'users.create',
    //    'users.edit',
]);

test('user pages can be accessed', function ($route, $permission) {
    $user = userWithPermission($permission);
    $to = str($route)->contains('.edit') ? route($route, $user) : route($route);
    $this->actingAs($user)->get($to)->assertOk();
})->with([
    ['users.index', 'view:users'],
    ['users.create', 'create:users'],
    //    ['users.edit', 'edit:users'],
]);

test('super admin can access user pages', function ($route) {
    $user = User::factory()->create()->assignRole('super_admin');
    $to = str($route)->contains('.edit') ? route($route, $user) : route($route);
    $this->actingAs($user)->get($to)->assertOk();
})->with([
    'users.index',
    'users.create',
    //    'users.edit',
]);
