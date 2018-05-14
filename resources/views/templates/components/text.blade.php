@php
    if(is_array($value) && isset($value['_value'])) $value = $value['_value'];
@endphp

@if(empty($value))
{{ $default }}
@else
{{ $value }}
@endif