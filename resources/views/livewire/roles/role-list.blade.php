<div class="standard-vert-spacing">
    <x-page-header
        heading="Manage User Roles"
        subheading="Roles are groups of permissions that are assigned to users. The assigned role controls what features of the application a user can access."
        action="Add New Role"
        :url="route('roles.create')"
    />

    @unless($this->roles->isEmpty())
        <flux:table>
            <flux:table.rows>
                <flux:table.columns>
                    <flux:table.column class="!pl-2">Role Name</flux:table.column>
                    <flux:table.column align="center">Permissions on Role</flux:table.column>
                    <flux:table.column align="center">Users with Role</flux:table.column>
                    <flux:table.column>Last Updated</flux:table.column>
                    <flux:table.column></flux:table.column>
                </flux:table.columns>
                @foreach($this->roles as $r)
                    <flux:table.row>
                        <flux:table.cell class="!pl-2">
                            <a href="{{route('roles.edit', $r)}}" class="hover:underline">
                                {{str($r->name)->headline()}}
                            </a>
                        </flux:table.cell>
                        <flux:table.cell align="center">{{$r->permissions_count}}</flux:table.cell>
                        <flux:table.cell align="center">{{$r->users_count}}</flux:table.cell>
                        <flux:table.cell>
                            {{ $r->updated_at->timezone('America/New_York')->diffInHours(now()) > 24
                                ? $r->updated_at->timezone('America/New_York')->format('M j, Y g:i A')
                                : $r->updated_at->timezone('America/New_York')->diffForHumans() }}
                        </flux:table.cell>
                        <flux:table.cell>
                            <div class="flex justify-end space-x-3">
                                @canOrSuper('edit:user_roles')
                                    <flux:button size="xs" variant="ghost" icon="pencil-square" :href="route('roles.edit', $r)" />
                                @endcanOrSuper
                                @canOrSuper('delete:user_roles')
                                    <flux:modal.trigger name="delete_{{$r->id}}">
                                        <flux:button size="xs" icon="trash" variant="ghost" class="cursor-pointer"/>
                                    </flux:modal.trigger>
                                    <flux:modal name="delete_{{$r->id}}" variant="bare" class="md:w-1/3">
                                        <x-modal-base title="Delete User Role: {{str($r->name)->headline()}}">
                                            <p>Are you sure you want to delete this user role? <strong>This cannot be undone.</strong></p>
                                            @if($r->users_count)
                                                <p class="text-red-800">There are {{$r->users_count}} {{str('user')->plural($r->users_count)}} that currently have this role assigned. Deleting this role will affect their ability to use the application. It's advised to remove this role from users before deleting it.</p>
                                            @endif
                                            <x-slot name="action">
                                                <flux:button variant="primary" wire:click="removeRole('{{$r->id}}')" color="red" size="sm">Delete Role</flux:button>
                                            </x-slot>
                                        </x-modal-base>
                                    </flux:modal>
                                @endcanOrSuper
                            </div>

                        </flux:table.cell>
                    </flux:table.row>
                @endforeach
            </flux:table.rows>
        </flux:table>
    @else
        <flux:callout icon="user-group" variant="secondary" heading="No User Roles were found" />
    @endunless
</div>
