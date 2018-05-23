@if(empty($value[0]['_value']))
    <div class="{{ $default }}-placeholder">
        <p>{{ Illuminate\Support\Str::upper($default) }}</p>
    </div>
@else
    @if(is_null(request()->input('relative')))
        <img src="{{ $value[0]['_value'] }}" alt="{{ $default }}">
    @else
        <img src="{{ absolute_to_relative_url($value[0]['_value']) }}" alt="{{ $default }}">
    @endif
@endif