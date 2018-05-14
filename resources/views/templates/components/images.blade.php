@if(empty($value))
    <div class="{{ $default }}-placeholder">
        <p>{{ Illuminate\Support\Str::upper($default) }}</p>
    </div>
@else
    <img src="{{ $value }}" alt="{{ $default }}">
@endif