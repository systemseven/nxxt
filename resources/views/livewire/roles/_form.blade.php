<div class="standard-form-spacing">
<x-form-section heading="Role Name" subheading="This name will be displayed across the application">
    <flux:input type="text" wire:model="form.name" label="Role Name" class="max-w-md"/>
</x-form-section>
<x-form-section heading="Role Permissions" subheading="Control what users assigned to this role will be able to do in the application">
    <div class="grid grid-cols-4 gap-8">
        @foreach(collect(config('nxxt.permissions'))->sortBy('label') as $p)
            <flux:checkbox.group wire:model="form.permissions">
                <flux:heading>{{ str($p['key'])->headline() }}</flux:heading>
                <ul class="space-y-2 border-t-2 pt-2 mt-1">
                    @foreach($p['set'] as $perm)
                    <li><flux:checkbox value="{{$perm}}:{{$p['key']}}" :label="str($perm)->headline()"/></li>
                    @endforeach
                </ul>
            </flux:checkbox.group>
        @endforeach
    </div>
    <flux:error name="form.permissions"/>
</x-form-section>

<x-form-section>
    <flux:button type="submit" variant="primary">{{$btn_label}}</flux:button>
</x-form-section>

</div>

