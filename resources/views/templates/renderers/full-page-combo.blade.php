@foreach($canvas->getOrigins() as $origin)

    <div style="
        position: absolute;
        background-color: {{sprintf('#%06X', mt_rand(0, 0xFFFFFF))}};
        top: {{ $origin->getPositionTop() }};
        left: {{ $origin->getPositionLeft() }};
        width: {{ $origin->getElement()->getPixelWidth() }};
        height: {{ $origin->getElement()->getPixelHeight() }};
    "></div>
@endforeach