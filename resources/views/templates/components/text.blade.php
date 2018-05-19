@php
    if(is_array($value) && isset($value['_value']))
    {
        $stringValue = $value['_value'];
    }
    else
    {
        $stringValue = $value;
    }
@endphp

@if(empty($stringValue))
{{ $default }}
@else

    @if(is_string($value))
        {{ $value }}
    @else
        <span style="font-size: {{ $value['size'] }}px; background-color: {{ $value['background_color'] }}; color: {{ $value['foreground_color'] }};">{{ $value['_value'] }}</span>
    @endif
@endif