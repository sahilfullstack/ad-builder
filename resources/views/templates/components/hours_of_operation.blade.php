@php
	if(is_array($value) && array_key_exists('_value', $value)) $value = $value['_value'];
	
	if(empty($value['title']))
	{
		$value = [
				'title'            => 'Hours Of Operation',
				'open_box_color'   => '#ffffff',
				'close_box_color'  => '#ffffff',
				'background_color' => '#ffffff',
				'foreground_color' => '#000000',
				'size' => '30',
			'values' => [
				[
					'day' => [
						'_value' => 'Day 1',
						'foreground_color' => '#000000',
						'size' => '30',
					],
					'open' => [
						'_value' => 'Day 1 OT',
						'foreground_color' => '#000000',
						'size' => '30',
					],
					'close' => [
						'_value' => 'Day 1 CT',
						'foreground_color' => '#000000',
						'size' => '30',
					]
				],
				[
					'day' => [
						'_value' => 'Day 2',
						'foreground_color' => '#000000',
						'size' => '30',
					],
					'open' => [
						'_value' => 'Day 2 OT',
						'foreground_color' => '#000000',
						'size' => '30',
					],
					'close' => [
						'_value' => 'Day 2 CT',
						'foreground_color' => '#000000',
						'size' => '30',
					]
				],
				[
					'day' => [
						'_value' => 'Day 3',
						'foreground_color' => '#000000',
						'size' => '30',
					],
					'open' => [
						'_value' => 'Day 3 OT',
						'foreground_color' => '#000000',
						'size' => '30',
					],
					'close' => [
						'_value' => 'Day 3 CT',
						'foreground_color' => '#000000',
						'size' => '30',
					]
				],
				[
					'day' => [
						'_value' => 'Day 4',
						'foreground_color' => '#000000',
						'size' => '30',
					],
					'open' => [
						'_value' => 'Day 4 OT',
						'foreground_color' => '#000000',
						'size' => '30',
					],
					'close' => [
						'_value' => 'Day 4 CT',
						'foreground_color' => '#000000',
						'size' => '30',
					]
				],
				[
					'day' => [
						'_value' => 'Day 5',
						'foreground_color' => '#000000',
						'size' => '30',
					],
					'open' => [
						'_value' => 'Day 5 OT',
						'foreground_color' => '#000000',
						'size' => '30',
					],
					'close' => [
						'_value' => 'Day 5 CT',
						'foreground_color' => '#000000',
						'size' => '30',
					]
				],
				[
					'day' => [
						'_value' => 'Day 6',
						'foreground_color' => '#000000',
						'size' => '30',
					],
					'open' => [
						'_value' => 'Day 6 OT',
						'foreground_color' => '#000000',
						'size' => '30',
					],
					'close' => [
						'_value' => 'Day 6 CT',
						'foreground_color' => '#000000',
						'size' => '30',
					]
				],
				[
					'day' => [
						'_value' => 'Day 7',
						'foreground_color' => '#000000',
						'size' => '30',
					],
					'open' => [
						'_value' => 'Day 7 OT',
						'foreground_color' => '#000000',
						'size' => '30',
					],
					'close' => [
						'_value' => 'Day 7 CT',
						'foreground_color' => '#000000',
						'size' => '30',
					]
				],
				[
					'day' => [
						'_value' => 'Day 8',
						'foreground_color' => '#000000',
						'size' => '30',
					],
					'open' => [
						'_value' => 'Day 8 OT',
						'foreground_color' => '#000000',
						'size' => '30',
					],
					'close' => [
						'_value' => 'Day 8 CT',
						'foreground_color' => '#000000',
						'size' => '30',
					]
				]			
			]	
		];
	}
@endphp

@if(empty($value['title']))
    <div class="placeholder">
        <p>{{ Illuminate\Support\Str::title($default) }}</p>
    </div>
@else

		@php
            $titleStyle = '';
            $openBoxStyle = '';
            $closeBoxStyle = '';

            if(isset($value['_value']['yes_button_color'])) $yesButtonStyle .= 'background-color: ' . $value['_value']['yes_button_color'] . ';';
            if(isset($value['_value']['no_button_color'])) $noButtonStyle .= 'background-color: ' . $value['_value']['no_button_color'] . ';';
        @endphp
    <p style="{{ $yesButtonStyle }};" class="operation-title">{{$value['title']}}</p>	
    <table class="operation-table">
	    <tr>
		    <th></th>
		    <th></th>
		    <th  bgcolor="#199FD4">Open</th>
		    <th  bgcolor="#199FD4"  class="lastcol">Close</th>
		</tr>
		@for ($i = 0; $i < count($value['values']); $i++)
		 	@php
                $yesButtonStyle = '';
                $noButtonStyle = '';

                if(isset($value['_value']['yes_button_color'])) $yesButtonStyle .= 'background-color: ' . $value['_value']['yes_button_color'] . ';';
                if(isset($value['_value']['no_button_color'])) $noButtonStyle .= 'background-color: ' . $value['_value']['no_button_color'] . ';';
            @endphp
			<tr>
	            <td>{{$value['values'][$i]['day']['_value']}}</td>
	            <td>&nbsp;</td>
	            <td class="firstcol">{{$value['values'][$i]['open']['_value']}}</td>
	            <td class="lastcol">{{$value['values'][$i]['close']['_value']}}</td>	          
	        </div>
		@endfor

    </table>
@endif