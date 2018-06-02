<style type="text/css">

	img.img-slideshow {
	  position: absolute;
	  transition: opacity .5s ease-in;
	}

	img.img-slideshow + img.img-slideshow { opacity: 0; }

</style>


@if(empty($value[0]['_value']))
    <div class="{{ $default }}-placeholder">
        <p>{{ Illuminate\Support\Str::title($default) }}</p>
    </div>
@else
	@for ($i = 0; $i < count($value); $i++)
		@isset($value[$i])
		<div>
			@if(is_null(request()->input('relative')))
		    	<img class="img-slideshow" src="{{ $value[$i]['_value'] }}" align="middle" alt="{{ $default }}">
			@else
				<img class="img-slideshow" src="{{ absolute_to_relative_url($value[$i]['_value']) }}" align="middle" alt="{{ $default }}">
			@endif
	    </div>		
	    @endisset
	@endfor
@endif

<script type="text/javascript">
// js for slide show
	var current = 0,
    slides = document.getElementsByClassName("img-slideshow");
setInterval(function() {
	console.log(slides.length);
  for (var i = 0; i < slides.length; i++) {
    slides[i].style.opacity = 0;
  }
  current = (current != slides.length - 1) ? current + 1 : 0;
  slides[current].style.opacity = 1;
}, 3000);
</script>