@php
    if(is_array($value) && array_key_exists('_value', $value)) $originalValue = $value['_value'];
    if(is_array($value) && array_key_exists('converted_value', $value)) $convertedValue = $value['converted_value'];
@endphp

@if(empty($originalValue))
    <div class="audio-placeholder">
        <p>{{ Illuminate\Support\Str::title($default) }}</p>
    </div>
@else
    @if(is_null(request()->input('relative')))
        <audio autoplay loop preload="auto"
            src="{{ $originalValue }}"
        >
    @else
        <audio autoplay loop preload="auto"
            src="{{ absolute_to_relative_url($convertedValue) }}"
        >
    @endif
@endif