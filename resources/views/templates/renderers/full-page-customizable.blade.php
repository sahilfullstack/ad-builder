<style>
    body {
        overflow: hidden;
        zoom: 50%;
    }
    body.two-x {
        zoom: 100%;
    }
</style>

<body>
    @foreach($canvas->getOrigins() as $origin)
        <iframe 
        id="iframe-renderer-{{ $origin->getElement()->getContent()->id }}"
        src="{{ route('units.render', array_merge(
            ['unit' => $origin->getElement()->getContent()->id], request()->query()
        ))}}"
        style="
            position: absolute;
            top: {{ $origin->getPositionTop() }};
            left: {{ $origin->getPositionLeft() }};
            width: {{ $origin->getElement()->getPixelWidth() }};
            height: {{ $origin->getElement()->getPixelHeight() }};
        "></iframe>
    @endforeach
</body>