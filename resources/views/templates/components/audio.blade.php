@php
    if(is_array($value) && isset($value['_value'])) $value = $value['_value'];
@endphp

@if(empty($value))
    <div class="audio-placeholder">
        <p>{{ Illuminate\Support\Str::title($default) }}</p>
    </div>
@else
    @if(is_null(request()->input('relative')))
        <audio autoplay loop preload="auto"
            src="{{ $value }}"
        >
    @else
        <audio autoplay loop preload="auto"
            src="{{ absolute_to_relative_url($value) }}"
        >
    @endif
@endif