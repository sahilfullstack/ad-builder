@php
    if(is_array($value) && array_key_exists('_value', $value)) $value = $value['_value'];
@endphp

@if(empty($value))
    <div class="placeholder">
        <p>{{ Illuminate\Support\Str::title($default) }}</p>
    </div>
@else
    <p class="timeline-title">{{$value['title']}}</p>
    <hr>
	<div class="timeline-entry-holder">
    	@for ($i = 0; $i < count($value['values']); $i++)
			@if($i % 2 == 0)
	        <div class="timeline-entry direction-d">
	       		 <div class="timeline-pin"></div>
	            <div class="timeline-month">{{$value['values'][$i]['month']}}</div>
	            <div class="timeline-year">{{$value['values'][$i]['year']}}</div>
	            <div class="timeline-entry-description">
	                {{$value['values'][$i]['description']}}
	            </div>
	            <div class="timeline-entry-image">
	                <img src="{{$value['values'][$i]['image']}}">
	            </div>
	        </div>
	        @else
	        <div class="timeline-entry direction-u">
	            <div class="timeline-pin"></div>
	            <div class="timeline-month">{{$value['values'][$i]['month']}}</div>
	            <div class="timeline-year">{{$value['values'][$i]['year']}}</div>
	            <div class="timeline-entry-description">
	                {{$value['values'][$i]['description']}}
	            </div>
	            <div class="timeline-entry-image">
	                <img src="{{$value['values'][$i]['image']}}">
	            </div>
	        </div>
	        @endif
		@endfor
	</div>
   
@endif