<?php

namespace App\Livewire\Roles;

use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;
use Spatie\Permission\Models\Role;

#[Title('Manage User Roles')]
class RoleList extends Component
{
    #[Computed]
    public function roles()
    {
        return Role::orderBy('name')->withCount(['permissions', 'users'])->get();
    }
}
