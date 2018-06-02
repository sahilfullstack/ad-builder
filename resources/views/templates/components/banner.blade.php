@php
    if(is_array($value) && array_key_exists('_value', $value)) $value = $value['_value'];
@endphp

@if(empty($value))
<div class="banner"></div>
@else
<div class="banner" style="background-color: {{ $value }}"></div>
@endif