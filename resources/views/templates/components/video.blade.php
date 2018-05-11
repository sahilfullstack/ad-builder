@if(empty($value))
    <div class="{{ $default }}-placeholder">
        <p>{{ Illuminate\Support\Str::upper($default) }}</p>
    </div>
@else
    <video autoplay loop preload="auto" muted
        src="{{ $value }}"
    >
@endif