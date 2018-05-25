@php
    if(is_array($value) && isset($value['_value'])) $value = $value['_value'];
    if( ! isset($size)) $size = 200;
@endphp

@if(empty($value))
    <div class="placeholder">
        <p>{{ Illuminate\Support\Str::title($default) }}</p>
    </div>
@else
    {!! QrCode::size($size)->generate($value) !!}
@endif