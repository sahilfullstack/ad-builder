@if(empty($value[0]['_value']))
    <div class="{{ $default }}-placeholder">
        <p>{{ Illuminate\Support\Str::upper($default) }}</p>
    </div>
@else
    <img src="{{ $value[0]['_value'] }}" alt="{{ $default }}">
@endif