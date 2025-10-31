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
        return Role::orderBy('name')->where('name', '!=', 'super_admin')->withCount(['permissions', 'users'])->get();
    }

    public function removeRole($role_id)
    {
        //delete from the role table
        //delete from the permission_role table
        dd('its morphin time...err deleting time...');
    }
}
