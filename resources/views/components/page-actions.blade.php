@props(['left', 'right'])
<section
    @class([
        'flex items-center space-x-4',
        'justify-start' => isset($left) && !isset($right),
        'justify-end' => isset($right) && !isset($left),
        'justify-between' => isset($left) && isset($right),
    ])>
    @isset($left)
        <div>
            {{$left}}
        </div>
    @endisset
    @isset($right)
        <div>
            {{$right}}
        </div>
    @endisset
</section>
