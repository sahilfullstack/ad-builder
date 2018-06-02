@php
    if(is_array($value) && array_key_exists('_value', $value)) $value = $value['_value'];
    if( ! isset($size)) $size = 200;

    $qr = new chillerlan\QRCode\QRCode(new chillerlan\QRCode\QROptions([
        'version'    => 5,
        'outputType' => chillerlan\QRCode\QRCode::OUTPUT_MARKUP_SVG,
        'eccLevel'   => chillerlan\QRCode\QRCode::ECC_L,
        'scale'      => 2
    ]));
@endphp

@if(empty($value))
    <div class="placeholder">
        <p>{{ Illuminate\Support\Str::title($default) }}</p>
    </div>
@else
    {!! $qr->render($value) !!}
    {{-- {!! QrCode::size($size)->generate($value) !!} --}}
@endif