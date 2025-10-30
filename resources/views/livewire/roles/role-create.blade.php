<div class="standard-vert-spacing">
    <x-page-header heading="Create User Role" action="Cancel" action_variant="filled" :url="route('roles.index')"/>

    <form wire:submit="save" class="standard-form-width">
        @include('livewire.roles._form', ['btn_label' => 'Create User Role'])
    </form>
</div>
