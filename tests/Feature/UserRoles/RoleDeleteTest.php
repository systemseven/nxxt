<?php

use App\Livewire\Roles\RoleList;
use App\Models\User;
use Spatie\Permission\Models\Role;

test('user role can be deleted', function () {
    $role = Role::create(['name' => 'test']);
    $user = User::factory()->create()->assignRole($role);
    $this->actingAs($user);
    Livewire::test(RoleList::class)
        ->call('removeRole', $role->id);

    $this->assertDatabaseMissing('roles', ['id' => $role->id]);
    $this->assertDatabaseMissing('permissions', ['role_id' => $role->id]);
});
