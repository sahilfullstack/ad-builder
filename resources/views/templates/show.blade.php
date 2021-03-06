@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h5>{{ $template->name }} <span class="badge badge-dark">{{ $template->type_human }}</span></h5></div>

                <div class="panel-body">
                    <p><strong>Created at:</strong> {{ $template->created_at->toDayDateTimeString() }}</p>
                    <p><strong>Last updated at:</strong> {{ $template->updated_at->toDayDateTimeString() }}</p>
                    
                    @if(! is_null($template->layout))
                        <p><strong>Layout:</strong> {{ $template->layout->name }}</p>
                    @endif

                    @if(! is_null($template->renderer))
                        <p><strong>Renderer:</strong> {{ $template->renderer }}</p>
                    @endif

                    <p><strong>Components contained:</strong></p>
                    
                    <!-- Components -->
                    @if($template->components->count() > 0)
                    <ul class="list-group">
                        @foreach($template->components as $component)
                            <li class="list-group-item">{{ $component->name }} <span class="badge badge-dark">{{ $component->type }}</span></li>
                        @endforeach
                    </ul>
                    @else
                        <em>No components yet.</em>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>
@endsection