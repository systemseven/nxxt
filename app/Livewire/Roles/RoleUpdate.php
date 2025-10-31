<?php

namespace App\Livewire\Roles;

use App\Livewire\Forms\RoleForm;
use Flux\Flux;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Title;
use Livewire\Component;
use Spatie\Permission\Models\Role;

#[Title('Update User Role')]
class RoleUpdate extends Component
{
    public RoleForm $form;

    public Role $role;

    public function mount(Role $role)
    {
        $this->role = $role;
        abort_if($role->name == 'super_admin', 403);

        $this->form->id = $role->id;
        $this->form->name = str($role->name)->headline()->toString();
        $this->form->permissions = $role->permissions->pluck('name')->toArray();
    }

    public function update()
    {
        $this->validate();

        try {
            DB::transaction(function () {
                $this->role->name = str($this->form->name)->slug('_');
                $this->role->save();
                $this->role->syncPermissions($this->form->permissions);
                activity()->performedOn($this->role)->log('Updated a User Role');
            });
            Flux::toast(text: 'Role has been successfully updated', heading: 'Role Updated!', variant: 'success');
        } catch (\Throwable $e) {
            Log::error(sprintf('[RoleCreate] %s', $e->getMessage()));
            Flux::toast(text: 'Your changes have not been saved', heading: 'Something went wrong', variant: 'danger');
        }
    }
}
