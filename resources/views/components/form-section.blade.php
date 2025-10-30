@props(['heading', 'subheading'])
<section {{$attributes->merge(['class' => 'grid grid-cols-3 gap-16 pb-12'])}}>
    <div>
        <flux:heading size="lg">{{$heading}}</flux:heading>
        @isset($subheading)
            <flux:subheading>{{$subheading}}</flux:subheading>
        @endisset
    </div>
    <div class="col-span-2">
        <div class="space-y-6">
            {{$slot}}
        </div>
    </div>
</section>
