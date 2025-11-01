<?php

namespace App\Actions\Users;

use App\Models\User;
use App\Notifications\UserAccountCreated;
use Illuminate\Support\Facades\Hash;

class CreateUser
{
    /**
     * Create a new class instance.
     */
    public static function execute($payload)
    {
        $role_id = html_entity_decode($payload['role_id']);
        unset($payload['role_id']);

        $payload['password'] = Hash::make(str()->random(16));

        $user = User::create($payload);
        $user->syncRoles($role_id);

        $user->notify(new UserAccountCreated($user));

        activity()->on($user)->log('Created a User Account');
    }
}
