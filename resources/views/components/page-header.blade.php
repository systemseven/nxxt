@props(['heading', 'subheading', 'action', 'url'])
<section>
    <div class="flex items-center justify-between">
        <div>
            <flux:heading size="xl" level="1">{{ $heading }}</flux:heading>
            @isset($subheading)
                <flux:subheading size="lg">{{ $subheading }}</flux:subheading>
            @endisset
        </div>
        <div>
            @if(isset($action) && isset($url))
                <flux:button variant="primary" href="{{ $url }}" wire:navigate>{{ $action }}</flux:button>
            @endif
        </div>
    </div>

    <flux:separator variant="subtle" class="mt-6"/>
</section>

