@php
    if(is_array($value) && array_key_exists('_value', $value)) $value = $value['_value'];
@endphp

@if(empty($value))
    <div class="placeholder">
        <p>{{ Illuminate\Support\Str::title($default) }}</p>
    </div>
@else
    @if(is_null(request()->input('relative')))
        <video autoplay loop preload="auto" muted
            src="{{ $value }}"
        >
    @else
        <video autoplay loop preload="auto" muted
            src="{{ absolute_to_relative_url($value) }}"
        >
    @endif
@endif