<?php

namespace App\Livewire\Users;

use App\Actions\Users\UpdateUser;
use App\Livewire\Forms\Users\UserForm;
use App\Models\User;
use Flux\Flux;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class UserUpdate extends Component
{
    public User $user;

    public UserForm $form;

    #[Computed]
    public function roles()
    {
        return Role::orderBy('name')->get();
    }

    public function mount(User $user)
    {
        $this->user = $user;
        $this->form->fill($user);
    }

    public function update()
    {
        $this->validate();
        UpdateUser::execute($this->form->toArray());

        Flux::toast(text: 'User has been successfully updated', heading: 'User Updated!', variant: 'success');
    }
}
