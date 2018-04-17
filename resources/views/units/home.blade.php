@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h1>
                Units 
                <create-unit-button></create-unit-button>
            </h1>
            <hr>

            @foreach($units as $unit)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5>{{ $unit->name }} <span class="badge badge-dark">{{ $unit->template->type_human }}</span></h5>
                        <a href="{{ route('units.edit', ['unit' => $unit]) }}">Edit</a>
                    </div>

                    <div class="panel-body">
                        <p><strong>Created at:</strong> {{ $unit->created_at->toDayDateTimeString() }}</p>
                        <p><strong>Last updated at:</strong> {{ $unit->updated_at->toDayDateTimeString() }}</p>
                        <p><strong>Components contained:</strong></p>
                        
                        <!-- Components -->
                        @if($unit->template->components->count() > 0)
                        <ul class="list-group">
                            @foreach($unit->template->components as $component)
                                <li class="list-group-item">
                                    <h5><strong>{{ $component->name }}</strong></h5>
                                    @if(isset($unit->components[$component->slug]))
                                        <p>{{ $unit->components[$component->slug] }}</p>
                                    @else
                                        <p>Not defined yet.</p>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                        @else
                            <em>No components contained.</em>
                        @endif
                    </div>

                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
