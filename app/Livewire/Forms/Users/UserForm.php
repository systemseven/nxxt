<?php

namespace App\Livewire\Forms\Users;

use Livewire\Form;

class UserForm extends Form
{
    public $first_name;

    public $last_name;

    public $email;

    public $role_id;

    public $active = true;

    public $require_mfa = false;

    public function rules()
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'role_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'First Name is required.',
            'last_name.required' => 'Last Name is required.',
            'email.required' => 'Email is required.',
            'email.email' => 'Email must be a valid email address.',
            'email.unique' => 'Email is already associated with an account.',
            'role_id.required' => 'Role is required.',
        ];
    }
}
