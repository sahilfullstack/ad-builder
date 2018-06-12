@php
	if(is_array($value) && array_key_exists('_value', $value)) $value = $value['_value'];
	
	if(empty($value['title']))
	{
		$value = [
			'title' => 'Hours Of Operation',
			'values' => [
				[
					'day' => 'Day 1',
					'open' => 'Day 1 OT',
					'close' => 'Day 1 CT'
				],
				[
					'day' => 'Day 2',
					'open' => 'Day 2 OT',
					'close' => 'Day 2 CT'
				],
				[
					'day' => 'Day 3',
					'open' => 'Day 3 OT',
					'close' => 'Day 3 CT'
				],
				[
					'day' => 'Day 4',
					'open' => 'Day 4 OT',
					'close' => 'Day 4 CT'
				],
				[
					'day' => 'Day 5',
					'open' => 'Day 5 OT',
					'close' => 'Day 5 CT'
				],
				[
					'day' => 'Day 6',
					'open' => 'Day 6 OT',
					'close' => 'Day 6 CT'
				],
				[
					'day' => 'Day 7',
					'open' => 'Day 7 OT',
					'close' => 'Day 7 CT'
				],[
					'day' => 'Day 8',
					'open' => 'Day 8 OT',
					'close' => 'Day 8 CT'
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
    <p class="operation-title">{{$value['title']}}</p>	
    <table class="operation-table">
	    <tr>
		    <th></th>
		    <th></th>
		    <th  bgcolor="#199FD4">Open</th>
		    <th  bgcolor="#199FD4"  class="lastcol">Close</th>
		</tr>
		@for ($i = 0; $i < count($value['values']); $i++)
			<tr>
	            <td>{{$value['values'][$i]['day']}}</td>
	            <td>&nbsp;</td>
	            <td class="firstcol">{{$value['values'][$i]['open']}}</td>
	            <td class="lastcol">{{$value['values'][$i]['close']}}</td>	          
	        </div>
		@endfor

    </table>
@endif