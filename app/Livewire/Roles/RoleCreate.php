<?php

namespace App\Livewire\Roles;

use App\Livewire\Forms\RoleForm;
use Flux\Flux;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Title;
use Livewire\Component;
use Spatie\Permission\Models\Role;

#[Title('Create User Role')]
class RoleCreate extends Component
{
    public RoleForm $form;

    public function save()
    {
        $this->validate();

        try {
            DB::transaction(function () {
                Role::create(['name' => str($this->form->name)->slug('_')])
                    ->givePermissionTo($this->form->permissions);
            });
            Flux::toast(text: 'Role has been successfully created', heading: 'Role Created!', variant: 'success');
        } catch (\Throwable $e) {
            Flux::toast(text: 'Your changes have not been saved', heading: 'Something went wrong', variant: 'danger');
        }

        $this->redirectRoute('roles.index', navigate: true);
    }
}
