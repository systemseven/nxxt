<?php

namespace App\Livewire\Roles;

use Flux\Flux;
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
        Role::where('id', $role_id)->delete();
        activity()
            ->log('Deleted a User Role');
        Flux::modal(sprintf('delete_%s', $role_id))->close();
        Flux::toast(text: 'Role has been successfully deleted', heading: 'Role Deleted', variant: 'danger');
    }
}
