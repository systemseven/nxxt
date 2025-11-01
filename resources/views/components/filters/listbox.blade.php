@props(['options' => []])
<flux:select variant="listbox" searchable {{$attributes->except('options')}}>
    @foreach($options as $value => $label)
        <flux:select.option value="{{$value}}">{{$label}}</flux:select.option>
    @endforeach
</flux:select>
