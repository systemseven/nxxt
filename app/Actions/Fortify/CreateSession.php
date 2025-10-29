<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CreateSession
{
    public function __invoke(Request $request)
    {
        $user = User::where('email', $request->email)
            ->first();

        if ($user && Hash::check($request->password, $user->password)) {
            $user->last_login_at = now();
            $user->save();

            return $user;
        }

        return null;
    }
}
