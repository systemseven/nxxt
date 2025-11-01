<div class="standard-vert-spacing">
    <x-page-header heading="Manage User: {{$user->name}}" action="Cancel" action_variant="filled" :url="route('users.index')"/>

    <form wire:submit="update" class="standard-form-width">
        @include('livewire.users._form', ['btn_label' => 'Edit Application User'])
    </form>
</div>
