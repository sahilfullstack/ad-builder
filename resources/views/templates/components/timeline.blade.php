@php
	if(is_array($value) && array_key_exists('_value', $value)) $value = $value['_value'];
	
	if(empty($value['title']))
	{
		$value = [
			'title' => 'Timeline Title',
			'values' => [
				[
					'year' => 'Year 1',
					'month' => 'Month 1',
					'description' => 'Description 1',
					'image' => 'http://placehold.it/77/73'
				],
				[
					'year' => 'Year 2',
					'month' => 'Month 2',
					'description' => 'Description 2',
					'image' => 'http://placehold.it/77/73'
				],
				[
					'year' => 'Year 3',
					'month' => 'Month 3',
					'description' => 'Description 3',
					'image' => 'http://placehold.it/77/73'
				],
				[
					'year' => 'Year 4',
					'month' => 'Month 4',
					'description' => 'Description 4',
					'image' => 'http://placehold.it/77/73'
				],
				[
					'year' => 'Year 5',
					'month' => 'Month 5',
					'description' => 'Description 5',
					'image' => 'http://placehold.it/77/73'
				],
				[
					'year' => 'Year 6',
					'month' => 'Month 6',
					'description' => 'Description 6',
					'image' => 'http://placehold.it/77/73'
				],
			]	
		];
	}
@endphp

@if(empty($value['title']))
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