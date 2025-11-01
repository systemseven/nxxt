<?php

namespace App\Livewire\Users;

use App\Models\User;
use Flux\Flux;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

#[Title('Manage Users')]
class UserList extends Component
{
    use withPagination;

    #[Url]
    public $filters = [
        'first_name',
        'last_name',
        'email',
        'role',
        'active' => 1,
    ];

    public function resetFilters()
    {
        $this->reset('filters');
    }

    #[Computed]
    public function emails()
    {
        return User::orderBy('email')->pluck('email')->mapWithKeys(function ($email) {
            return [$email => $email];
        });
    }

    #[Computed]
    public function roles()
    {
        return Role::orderBy('name')->pluck('name')->mapWithKeys(function ($name) {
            return [$name => str($name)->headline()->toString()];
        });
    }

    public function toggleActive($id)
    {
        $user = User::find($id);
        $user->active = ! $user->active;

        if (! $user->active) {
            $user->deleted_at = now();
        }

        $user->save();
        $msg = sprintf('%s has been successfully %s', $user->name, $user->active ? 'activated' : 'deactivated');
        Flux::modal(sprintf('delete_%s', $id))->close();
        Flux::toast(text: $msg, heading: 'User Updated!', variant: 'danger');
    }

    #[Computed]
    public function users()
    {
        return User::with(['roles'])
            ->when($this->filters['first_name'] ?? null, function ($query, $value) {
                $query->where('first_name', 'like', "%{$value}%");
            })
            ->when($this->filters['last_name'] ?? null, function ($query, $value) {
                $query->where('last_name', 'like', "%{$value}%");
            })
            ->when($this->filters['email'] ?? null, function ($query, $value) {
                $query->where('email', 'like', "%{$value}%");
            })
            ->when($this->filters['role'] ?? null, function ($query, $value) {
                $query->whereHas('roles', function ($q) use ($value) {
                    $name = html_entity_decode($value);
                    $q->where('name', $name);
                });
            })
            ->when(isset($this->filters['active']), function ($query) {
                $query->where('active', $this->filters['active']);
            })
            ->orderBy('last_name')
            ->orderBy('first_name')
            ->paginate(15);
    }
}
