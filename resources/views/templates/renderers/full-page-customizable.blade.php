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
        src="{{ route('units.render', array_merge(
            ['unit' => $origin->getElement()->getContent()->id], request()->query()
        ))}}"
        style="
            position: absolute;
            background-color: {{sprintf('#%06X', mt_rand(0, 0xFFFFFF))}};
            top: {{ $origin->getPositionTop() }};
            left: {{ $origin->getPositionLeft() }};
            width: {{ $origin->getElement()->getPixelWidth() }};
            height: {{ $origin->getElement()->getPixelHeight() }};
        "></iframe>
    @endforeach
</body>