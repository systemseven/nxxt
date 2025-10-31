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
                    <flux:table.column>Actions</flux:table.column>
                </flux:table.columns>
                @foreach($this->roles as $r)
                    <flux:table.row>
                        <flux:table.cell class="!pl-2">
                            <a href="" class="hover:underline">
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
                            ...
                        </flux:table.cell>
                    </flux:table.row>
                @endforeach
            </flux:table.rows>
        </flux:table>
    @else
        <flux:callout icon="user-group" variant="secondary" heading="No User Roles were found" />
    @endunless
</div>
