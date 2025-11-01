<?php

use App\Livewire\Users\UserUpdate;
use App\Models\User;

test('user create renders', function () {
    $this->actingAs(userWithPermission('edit:users'))->get(route('users.edit', User::factory()->create()))
        ->assertSeeLivewire(UserUpdate::class);
});

test('user can be updated', function () {
    $user = User::factory()->create()->assignRole('super_admin');
    $formData = $user->only(['id', 'email', 'first_name', 'last_name']);
    $formData['first_name'] = 'Updated';
    $formData['role_id'] = 'super_admin';
    $response = Livewire::test(UserUpdate::class, ['user' => $user])
        ->set('form', $formData)
        ->call('update');

    $response->assertHasNoErrors();

    $this->assertDatabaseHas('users', ['id' => $user->id, 'first_name' => $formData['first_name']]);

    $user = User::where('email', $formData['email'])->first();
    $this->assertTrue($user->hasRole('super_admin'));

});
