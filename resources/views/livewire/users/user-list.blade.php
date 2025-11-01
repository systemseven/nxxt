<div class="standard-vert-spacing">
     <x-page-header heading="Manage Users" subheading="Manage Users that have access to the application. This is for both first-party and third-party application users" action="Add New User" :url="route('users.create')"/>
     <x-page-actions>
         <x-slot name="left">
             <flux:button :href="route('dashboard') .'?'. urldecode(http_build_query(['filters' => $this->filters]))">Export Users</flux:button>
         </x-slot>
         <x-slot name="right">
             <div class="flex items-center space-x-2">
                 <x-filters.text wire:model.live.debounce.200ms="filters.first_name" placeholder="First Name" />
                 <x-filters.text wire:model.live.debounce.200ms="filters.last_name" placeholder="Last Name" />
                 <x-filters.listbox wire:model.live="filters.email" placeholder="Email" :options="$this->emails" />
                 <x-filters.listbox wire:model.live="filters.role" placeholder="Role" :options="$this->roles" />
                 <x-filters.active-disabled wire:model.live="filters.active" />
                 <flux:button wire:click="resetFilters" variant="ghost" >Reset</flux:button>
             </div>
         </x-slot>
     </x-page-actions>

    @unless($this->users->isEmpty())
        <flux:table :paginate="$this->users">
            <flux:table.columns>
                <flux:table.column>Active</flux:table.column>
                <flux:table.column>First Name</flux:table.column>
                <flux:table.column>Last Name</flux:table.column>
                <flux:table.column>Email</flux:table.column>
                <flux:table.column>Role</flux:table.column>
                <flux:table.column>Last Login</flux:table.column>
                <flux:table.column></flux:table.column>
            </flux:table.columns>
            <flux:table.rows>
                @foreach($this->users as $u)
                    <flux:table.row>
                        <flux:table.cell>
                            <x-active-badge :active="$u->active" />
                        </flux:table.cell>
                        <flux:table.cell>{{$u->first_name}}</flux:table.cell>
                        <flux:table.cell>{{$u->last_name}}</flux:table.cell>
                        <flux:table.cell>{{$u->email}}</flux:table.cell>
                        <flux:table.cell>
                            <x-role-badge :roles="$u->roles" />
                        </flux:table.cell>
                        <flux:table.cell>{{$u->last_login_at ? human_or_datetime($u->last_login_at) : '-'}}</flux:table.cell>
                        <flux:table.cell>
                            @canOrSuper('edit:users')
                                <flux:button size="xs" variant="ghost" icon="pencil-square" :href="route('users.edit', $u)"/>
                            @endcanOrSuper
                            @canOrSuper('delete:users')
                                <flux:modal.trigger name="delete_{{$u->id}}">
                                    <flux:button size="xs" icon="trash" variant="ghost" class="cursor-pointer"/>
                                </flux:modal.trigger>
                                <flux:modal name="delete_{{$u->id}}" variant="bare" class="md:w-1/3">
                                    <x-modal-base title="Delete User Role: {{str($u->name)->headline()}}">
                                        <p>Are you sure you want to delete this user role? <strong>This cannot be undone.</strong></p>
                                        <x-slot name="action">
                                            <flux:button variant="primary" wire:click="removeRole('{{$u->id}}')" color="red" size="sm">Delete Role</flux:button>
                                        </x-slot>
                                    </x-modal-base>
                                </flux:modal>
                            @endcanOrSuper
                        </flux:table.cell>
                    </flux:table.row>
                @endforeach
            </flux:table.rows>
        </flux:table>
    @else
        <flux:callout icon="user-group" variant="secondary" heading="No Users were found matching your criteria" />
    @endunless
</div>
