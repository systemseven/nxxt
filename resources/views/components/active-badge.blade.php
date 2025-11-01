@props(['active'])
@if($active)
    <flux:badge color="emerald" size="sm">Active</flux:badge>
@else
    <flux:badge color="rose" size="sm">Disabled</flux:badge>
@endif
