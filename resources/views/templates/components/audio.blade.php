@php
    if(is_array($value) && array_key_exists('_value', $value)) $originalValue = $value['_value'];
    if(is_array($value) && array_key_exists('converted_value', $value)) $convertedValue = $value['converted_value'];
@endphp

@if(empty($originalValue))
    <div class="audio-placeholder">
        <p>{{ Illuminate\Support\Str::title($default) }}</p>
    </div>
@else
    @if(is_null(request()->input('relative')))
        <audio autoplay loop preload="auto"
            src="{{ $originalValue }}"
        ></audio>
    @else
        <audio autoplay loop preload="auto"
            src="{{ absolute_to_relative_url($convertedValue) }}"
        ></audio>
    @endif
    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 503.664 503.664" style="enable-background:new 0 0 503.664 503.664;display:block;margin:0 auto;width: 100px;" xml:space="preserve">
        <g>
            <g>
                <path d="M473.288,301.996h-1.14v-41.512c0-121.372-98.944-220.124-220.324-220.124c-121.372,0-220.32,98.752-220.32,220.124
                    v41.512h-1.136C13.624,301.996,0,314.52,0,331.272l0.064,77.624c0,16.752,13.624,30.8,30.368,30.8h2.072
                    c3.116,15.736,15.18,23.6,29.572,23.6h16.672c16.744,0,31.452-15.632,31.452-32.392V307.58c0-16.996-14.992-29.192-31.452-29.192
                    h-3.964V257.32c0-97.892,79.152-177.54,177.048-177.54c97.888,0,177.044,79.648,177.044,177.54v21.068h-3.96
                    c-16.46,0-31.452,12.196-31.452,29.192v123.332c0,16.756,14.704,32.392,31.452,32.392h16.672c14.392,0,26.452-7.868,29.572-23.6
                    h2.072c16.752,0,30.368-14.6,30.368-31.352l0.064-76.592C503.656,315.012,490.04,301.996,473.288,301.996z"/>
            </g>
        </g>
    </svg>

    <button style="width: 90px;height: 50px;margin-top:10px;" onclick="play()">
        <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;width: 30px;" xml:space="preserve">
            <g>
                <g>
                    <g>
                        <polygon points="213.342,341.338 327.113,256.004 213.342,170.671 			"/>
                        <path d="M256,0C114.837,0,0,114.837,0,256s114.837,256,256,256c141.184,0,256-114.837,256-256S397.184,0,256,0z M375.467,273.067
                            l-170.667,128c-3.755,2.816-8.277,4.267-12.8,4.267c-3.243,0-6.507-0.725-9.536-2.24c-7.232-3.627-11.797-11.008-11.797-19.093
                            V128c0-8.085,4.565-15.467,11.797-19.072c7.211-3.627,15.872-2.859,22.336,2.005l170.667,128C380.843,242.965,384,249.28,384,256
                            C384,262.72,380.843,269.056,375.467,273.067z"/>
                    </g>
                </g>
            </g>
        </svg>
    </button>
    <button style="width: 90px;height: 50px;" onclick="pause()">
        <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
            viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;width: 30px;" xml:space="preserve" style="width: 30px;">
        <g>
            <g>
                <path d="M256,0C114.837,0,0,114.837,0,256s114.837,256,256,256s256-114.837,256-256S397.163,0,256,0z M234.667,362.667
                    c0,11.776-9.536,21.333-21.333,21.333h-64C137.536,384,128,374.443,128,362.667V149.333c0-11.776,9.536-21.333,21.333-21.333h64
                    c11.797,0,21.333,9.557,21.333,21.333V362.667z M384,362.667c0,11.776-9.536,21.333-21.333,21.333h-64
                    c-11.797,0-21.333-9.557-21.333-21.333V149.333c0-11.776,9.536-21.333,21.333-21.333h64c11.797,0,21.333,9.557,21.333,21.333
                    V362.667z"/>
            </g>
        </g>
        </svg>
    </button>

    <script>
        function play() {
            document.getElementsByTagName('audio')[0].play()
        }

        function pause() {
            document.getElementsByTagName('audio')[0].pause()
        }
    </script>
@endif