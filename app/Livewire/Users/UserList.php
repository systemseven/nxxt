<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Manage Users')]
class UserList extends Component
{
    #[Computed]
    public function users()
    {
        return User::with(['roles'])->orderBy('last_name')->orderBy('first_name')->paginate(25);
    }
}
