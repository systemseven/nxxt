<?php

use App\Livewire\Roles\RoleUpdate;
use Spatie\Permission\Models\Role;

test('user role update screen renders', function () {
    $role = Role::where('name', '!=', 'super_admin')->first();
    $this->actingAs(userWithPermission('edit:user_roles'))->get(route('roles.edit', $role))
        ->assertSeeLivewire(RoleUpdate::class);
});

test('user role can be updated', function () {
    $role = Role::where('name', '!=', 'super_admin')->first();
    $response = Livewire::test(RoleUpdate::class, ['role' => $role])
        ->set('form.name', 'Update Role')
        ->set('form.permissions', ['create:user_roles'])
        ->call('update');

    $response->assertHasNoErrors();

    $this->assertDatabaseHas('roles', ['id' => $role->id, 'name' => str('Update Role')->slug('_')]);
});

test('user role update validates', function ($formData, $expectedErrorField) {
    $role = Role::where('name', '!=', 'super_admin')->first();
    $response = Livewire::test(RoleUpdate::class, ['role' => $role])
        ->set('form', $formData)
        ->call('update')
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
