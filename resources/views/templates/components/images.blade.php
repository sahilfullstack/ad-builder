@if(empty($value[0]['_value']))
    <div class="{{ $default }}-placeholder">
        <p>{{ Illuminate\Support\Str::upper($default) }}</p>
    </div>
@else
    <img src="{{ absolute_to_relative_url($value[0]['_value']) }}" alt="{{ $default }}">
@endif