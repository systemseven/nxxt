<?php

use App\Livewire\Users\UserCreate;

test('user create renders', function () {
    $this->actingAs(userWithPermission('create:users'))->get(route('users.create'))
        ->assertSeeLivewire(UserCreate::class);
});

test('user can be created', function () {})->skip();

test('user create validates', function () {})->skip();
