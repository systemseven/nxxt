<?php

use App\Livewire\Users\UserCreate;
use App\Models\User;

test('user create renders', function () {
    $this->actingAs(userWithPermission('create:users'))->get(route('users.create'))
        ->assertSeeLivewire(UserCreate::class);
});

test('user can be created', function () {
    $formData = User::factory()->make()->only(['email', 'first_name', 'last_name']);
    $formData['role_id'] = 'super_admin';
    $response = Livewire::test(UserCreate::class)
        ->set('form', $formData)
        ->call('save');

    $response->assertHasNoErrors();

    $this->assertDatabaseHas('users', ['email' => $formData['email']]);

    $user = User::where('email', $formData['email'])->first();
    $this->assertTrue($user->hasRole('super_admin'));

});

test('user create validates', function ($data, $field) {
    Livewire::test(UserCreate::class)
        ->set('form', $data)
        ->call('save')
        ->assertHasErrors($field);
})->with([
    [
        [],
        ['form.first_name', 'form.last_name', 'form.email', 'form.role_id'], // Missing fields
    ],
    [
        ['form.email' => 'notanemail'],
        ['form.email'], // Invalid Email
    ],
]);
