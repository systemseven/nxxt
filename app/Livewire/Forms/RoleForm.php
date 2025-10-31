<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use Spatie\Permission\Models\Role;

class RoleForm extends Form
{
    public $id;

    public $name;

    public $permissions;

    public function rules()
    {
        $slug = str($this->name)->slug('_');

        return [
            'name' => [
                'required',
                function ($attribute, $value, $fail) use ($slug) {
                    $query = Role::where('name', $slug);

                    if ($this->id) {
                        $query->where('id', '!=', $this->id);
                    }

                    if ($query->exists()) {
                        $fail('A Role with this name already exists.');
                    }
                },
            ],
            'permissions' => 'required|array|min:1',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required.',
            'permissions.required' => 'At least one permission is required.',
            'permissions.min' => 'You must choose at least 1 permission',
        ];
    }
}
