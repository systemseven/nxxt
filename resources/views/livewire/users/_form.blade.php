<div class="standard-form-spacing">
    <x-form-section heading="User Information" subheading="Basic information about this user">
        <div class="grid grid-cols-2 gap-6">
            <flux:input label="First Name" wire:model="form.first_name"/>
            <flux:input label="Last Name" wire:model="form.last_name"/>
        </div>
        <div class="grid grid-cols-2 gap-6">
            <flux:input type="email" label="Email Address" wire:model="form.email"/>
        </div>
    </x-form-section>

    <x-form-section heading="Application Access" subheading="Control settings related to this users access to the application">
        <div class="space-y-8">
            <flux:switch wire:model="form.active" label="Account is Active" description="When selected this user will be able to login and access the application" align="left" />
            <flux:switch wire:model="form.require_mfa" label="Require MFA" description="Should the user be sent an email with a verfication code to complete their login" align="left" />
        </div>
    </x-form-section>

    <x-form-section heading="Permissions" subheading="Assigning a role will control the features that this user can access. This will also control what items they see in the navigation bar.">
        <flux:select variant="listbox" searchable placeholder="Assign Role" class="max-w-sm" wire:model="form.role_id">
            @foreach($this->roles as $r)
                <flux:select.option value="{{$r->id}}">{{str($r->name)->headline()}}</flux:select.option>
            @endforeach
        </flux:select>
        <flux:error name="form.role_id" />
    </x-form-section>

    <x-form-section>
        <flux:button type="submit" variant="primary">{{$btn_label}}</flux:button>
    </x-form-section>
</div>
