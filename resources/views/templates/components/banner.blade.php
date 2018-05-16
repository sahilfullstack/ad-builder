@php
    if(is_array($value) && isset($value['_value'])) $value = $value['_value'];
@endphp

@if(empty($value))
<div class="banner"></div>
@else
<div class="banner" style="background-color: {{ $value }}"></div>
@endif