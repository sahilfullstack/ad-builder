@php
    if(is_array($value) && array_key_exists('_value', $value))
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
        @php
            $style = '';
            if(isset($value['size'])) $style .= 'font-size: ' . $value['size'] . 'px;';
            if(isset($value['foreground_color'])) $style .= 'color: ' . $value['foreground_color'] . ';';
        @endphp
        <span style="{{ $style }};">{{ $value['_value'] }}</span>
    @endif
@endif