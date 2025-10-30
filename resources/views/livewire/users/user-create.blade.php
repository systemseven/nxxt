<div class="standard-vert-spacing">
    <x-page-header heading="Create Application User" action="Cancel" action_variant="filled" :url="route('users.index')"/>

    <form wire:submit="save" class="standard-form-width">
        @include('livewire.users._form', ['btn_label' => 'Create Application User'])
    </form>
</div>
