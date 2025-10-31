<div class="standard-vert-spacing">
     <x-page-header heading="Manage Users" subheading="Manage Users that have access to the application. This is for both first-party and third-party application users" action="Add New User" :url="route('users.create')"/>
     <x-page-actions>
         <x-slot name="left">
             <flux:button>Export Users</flux:button>
         </x-slot>
         <x-slot name="right">
             --first name--
             --last name--
             --role--
             --email--
             <x-active-disabled-dropdown />
         </x-slot>
     </x-page-actions>

     table columns: active, role?, first name, last name, email, last login, account

    <flux:callout icon="user-group" variant="secondary" heading="No Users were found matching your criteria" />
</div>
