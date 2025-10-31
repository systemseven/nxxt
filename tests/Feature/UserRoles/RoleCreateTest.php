<?php

use App\Livewire\Roles\RoleCreate;

test('user role create screen renders', function () {
    $this->actingAs(userWithPermission('create:user_roles'))->get(route('roles.create'))
        ->assertSeeLivewire(RoleCreate::class);
});

test('user role can be created', function () {
    $response = Livewire::test(RoleCreate::class)
        ->set('form.name', 'Test Role')
        ->set('form.permissions', ['create:user_roles'])
        ->call('save');

    $response->assertHasNoErrors();

    $this->assertDatabaseHas('roles', ['name' => str('Test Role')->slug('_')]);
});

test('user role create validates', function ($formData, $expectedErrorField) {
    Livewire::test(RoleCreate::class)
        ->set('form', $formData)
        ->call('save')
        ->assertHasErrors([$expectedErrorField]);
})->with([
    [
        ['name' => '', 'permissions' => ['create:user_roles']],
        'form.name', // Missing name
    ],
    [
        ['name' => 'Test Role', 'permissions' => []],
        'form.permissions', // Missing permissions
    ],
]);
