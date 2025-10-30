<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class RoleForm extends Form
{
    #[Validate('required|unique:roles,name')]
    public $name;

    #[Validate('required|array|min:1')]
    public $permissions;

    public function messages()
    {
        return [
            'name.required' => 'Name is required.',
            'permissions.required' => 'At least one permission is required.',
            'permissions.min' => 'You must choose at least 1 permission',
        ];
    }
}
