@php
    if(is_array($value) && isset($value['_value'])) $value = $value['_value'];
@endphp

@if(empty($value))
    <div class="placeholder">
        <p>{{ Illuminate\Support\Str::title($default) }}</p>
    </div>
@else
    <img src="{{ absolute_to_relative_url($value) }}" alt="{{ $default }}">
@endif