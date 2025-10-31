<?php

namespace App\Livewire\Users;

use App\Livewire\Forms\Users\UserForm;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;
use Spatie\Permission\Models\Role;

#[Title('Create Application User')]
class UserCreate extends Component
{
    public UserForm $form;

    // TODO: this may be repeated across the userupdate - worth extracting?
    #[Computed]
    public function roles()
    {
        return Role::orderBy('name')->get();
    }

    public function save()
    {
        $this->validate();

        dd($this->form);
    }
}
