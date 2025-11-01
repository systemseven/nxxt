<?php

namespace App\Actions\Users;

use App\Models\User;
use App\Notifications\UserAccountCreated;

class CreateUser
{
    /**
     * Create a new class instance.
     */
    public static function execute($payload)
    {
        $role_id = $payload['role_id'];
        unset($payload['role_id']);

        $user = User::create($payload);
        $user->syncRoles($role_id);

        $user->notify(new UserAccountCreated($user));

        activity()->on($user)->log('Created a User Account');
    }
}
