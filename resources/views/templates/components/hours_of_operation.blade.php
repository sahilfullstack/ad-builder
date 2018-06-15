@php
	if(is_array($value) && array_key_exists('_value', $value)) $value = $value['_value'];
	
	if(empty($value['title']))
	{
		$value = [
				'title'            => 'Hours Of Operation',
				'open_box'   => [
					'_value' => 'Open',
					'background_color' => '#199FD4',
					'foreground_color' => '#000000',
					'size' => '30'
				],
				'close_box'   => [
					'_value' => 'Close',
					'background_color' => '#199FD4',
					'foreground_color' => '#000000',
					'size' => '30'
				],
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

            if(isset($value['size'])) $titleStyle .= 'font-size: ' . $value['size'] . 'px;';
            if(isset($value['foreground_color'])) $titleStyle .= 'color: ' . $value['foreground_color'] . ';';      

            if(isset($value['open_box']['size'])) $openBoxStyle .= 'font-size: ' . $value['open_box']['size'] . 'px;';
            if(isset($value['open_box']['foreground_color'])) $openBoxStyle .= 'color: ' . $value['open_box']['foreground_color'] . ';';      
            if(isset($value['open_box']['background_color'])) $openBoxStyle .= 'background-color: ' . $value['open_box']['background_color'] . ';';      

            if(isset($value['close_box']['size'])) $closeBoxStyle .= 'font-size: ' . $value['close_box']['size'] . 'px;';
            if(isset($value['close_box']['foreground_color'])) $closeBoxStyle .= 'color: ' . $value['close_box']['foreground_color'] . ';';      
            if(isset($value['close_box']['background_color'])) $closeBoxStyle .= 'background-color: ' . $value['close_box']['background_color'] . ';';              
        @endphp
    <p style="{{ $titleStyle }};" class="operation-title">{{$value['title']}}</p>	
    <table class="operation-table">
	    <tr>
		    <th></th>
		    <th></th>
		    <th  style="{{ $openBoxStyle }};" >{{$value['open_box']['_value']}}</th>
		    <th  style="{{ $closeBoxStyle }};" class="lastcol">{{$value['close_box']['_value']}}</th>
		</tr>
		@for ($i = 0; $i < count($value['values']); $i++)
		 	@php
		 		$dayStyle = '';
		 		$openStyle = '';
		 		$closeStyle = '';

	            if(isset($value['values'][$i]['day']['size'])) $dayStyle .= 'font-size: ' . $value['values'][$i]['day']['size'] . 'px;';
	            if(isset($value['values'][$i]['day']['foreground_color'])) $dayStyle .= 'color: ' . $value['values'][$i]['day']['foreground_color'] . ';';      

	           	if(isset($value['values'][$i]['open']['size'])) $openStyle .= 'font-size: ' . $value['values'][$i]['open']['size'] . 'px;';
	            if(isset($value['values'][$i]['open']['foreground_color'])) $openStyle .= 'color: ' . $value['values'][$i]['open']['foreground_color'] . ';';      

	           	if(isset($value['values'][$i]['close']['size'])) $closeStyle .= 'font-size: ' . $value['values'][$i]['close']['size'] . 'px;';
	            if(isset($value['values'][$i]['close']['foreground_color'])) $closeStyle .= 'color: ' . $value['values'][$i]['close']['foreground_color'] . ';';      

            @endphp
			<tr>
	            <td style="{{ $dayStyle }};">{{$value['values'][$i]['day']['_value']}}</td>
	            <td>&nbsp;</td>
	            <td style="{{ $openStyle }};" class="firstcol">{{$value['values'][$i]['open']['_value']}}</td>
	            <td style="{{ $closeStyle }};" class="lastcol">{{$value['values'][$i]['close']['_value']}}</td>	          
	        </div>
		@endfor

    </table>
@endif