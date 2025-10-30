<?php

namespace App\Livewire\Users;

use App\Livewire\Forms\Users\UserForm;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Create Application User')]
class UserCreate extends Component
{
    public UserForm $form;

    public function save()
    {
        $this->validate();

        dd($this->form);
    }

}
