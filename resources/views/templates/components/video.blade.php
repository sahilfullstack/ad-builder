@php
    if(is_array($value) && isset($value['_value'])) $value = $value['_value'];
@endphp

@if(empty($value))
    <div class="{{ $default }}-placeholder">
        <p>{{ Illuminate\Support\Str::upper($default) }}</p>
    </div>
@else
    <video autoplay loop preload="auto" muted
        src="{{ $value }}"
    >
@endif