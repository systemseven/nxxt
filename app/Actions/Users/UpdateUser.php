<?php

namespace App\Actions\Users;

use App\Models\User;

class UpdateUser
{
    /**
     * Create a new class instance.
     */
    public static function execute($payload)
    {
        $user = User::find($payload['id']);
        $role_id = $payload['role_id'];

        $user->fill(collect($payload)->except(['id', 'role_id'])->toArray());
        $user->save();

        $user->syncRoles($role_id);

    }
}
