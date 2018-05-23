@if(empty($value[0]['_value']))
    <div class="{{ $default }}-placeholder">
        <p>{{ Illuminate\Support\Str::upper($default) }}</p>
    </div>
@else
	@for ($i = 0; $i < count($value); $i++)
		@isset($value[$i])
		<div style="float:left; margin:10px;">
			@if(is_null(request()->input('relative')))
		    	<img src="{{ $value[$i]['_value'] }}" align="middle" alt="{{ $default }}">
			@else
				<img src="{{ absolute_to_relative_url($value[$i]['_value']) }}" align="middle" alt="{{ $default }}">
			@endif
	    </div>		
	    @endisset
	@endfor
@endif