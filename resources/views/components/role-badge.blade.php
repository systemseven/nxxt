@props(['roles'])
@unless($roles->isEmpty())
    <flux:badge size="sm">{{str($roles->first()?->name)->headline()}}</flux:badge>
@else
&mdash;
@endif
