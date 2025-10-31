<div class="standard-vert-spacing">
    <x-page-header heading="Update User Role" action="Cancel" action_variant="filled" :url="route('roles.index')"/>

    <form wire:submit="update" class="standard-form-width">
        @include('livewire.roles._form', ['btn_label' => 'Update User Role'])
    </form>
</div>
