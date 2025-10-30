<div class="space-y-8">
     <x-page-header heading="Manage Users" action="Add New User" :url="route('dashboard')"/>
     <x-page-actions>
         <x-slot name="left">
             <flux:button>Export Users</flux:button>
         </x-slot>
         <x-slot name="right">
             --first name--
             --last name--
             --email--
             --status--
         </x-slot>
     </x-page-actions>

     table columns: active, role?, first name, last name, email, last login, account

    <flux:callout icon="user-group" variant="secondary" heading="No Users found matching your criteria" />
</div>
