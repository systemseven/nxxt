@props(['title', 'action'])
<div class="relative rounded-lg border border-white/30 bg-white/60 backdrop-blur-lg shadow-2xl ring-1 ring-inset ring-white/10 p-0.5">
    <div class="bg-white rounded-md p-4 border border-gray-300/90">
        <div class="space-y-6">
            <flux:heading size="lg" class="border-b pb-1 mb-3">{{$title}}</flux:heading>

            <div class="space-y-3">
                {{$slot}}
            </div>

            <div class="flex items-center justify-between pl-2">
                <flux:modal.close>
                    <flux:button variant="ghost" inset>Cancel</flux:button>
                </flux:modal.close>
                {{$action}}
            </div>
        </div>
    </div>
</div>
