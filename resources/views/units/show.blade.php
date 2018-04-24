@extends('layouts.app')

@section('content')
<div class="container">
    <div class="panel panel-default">
        <div class="panel-body">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
              <li role="presentation" class="active"><a href="#ad" aria-controls="ad" role="tab" data-toggle="tab">Ad</a></li>
              <li role="presentation"><a href="#page" aria-controls="page" role="tab" data-toggle="tab">Landing Page</a></li>
            </ul>
          
            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="ad">
                    <h2>
                        @if(! is_null($unit->name))
                            <strong>{{ $unit->name }}</strong>
                        @else
                            <em>Untitled</em>
                        @endif
                        <span class="badge badge-dark">{{ $unit->state }}</span>
                    </h2>
                    <a href="{{ route('units.edit', ['unit' => $unit]) }}">Edit</a>

                    <hr>

                    <p><strong>Created at:</strong> {{ $unit->created_at->toDayDateTimeString() }}</p>
                    <p><strong>Last updated at:</strong> {{ $unit->updated_at->toDayDateTimeString() }}</p>
                    
                    @if(is_null($unit->template))
                    <p>No template selected yet.</p>
                    @else
                        <p><strong>Template:</strong> {{ $unit->template->name }}</p>
                        <p><strong>Components contained:</strong></p>
                        
                        <!-- Components -->
                        @if($unit->template->components->count() > 0)
                        <ul class="list-group">
                            @foreach($unit->template->components as $component)
                                <li class="list-group-item">
                                    <h5><strong>{{ $component->name }}</strong></h5>
                                    @if(! empty($unit->components[$component->slug]))
                                        <p>{{ $unit->components[$component->slug] }}</p>
                                    @else
                                        <p><em>Not defined yet.</em></p>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                        @else
                            <em>No components contained.</em>
                        @endif
                    @endif

                    <hr>
                    <p><strong>PREVIEW</strong></p>
                    <iframe id="rederer-iframe" src="{{ route('units.render', ['unit' => $unit, 'nullable' => 'y']) }}" frameborder="0" width="960" height="540"></iframe>
                </div>
                <div role="tabpanel" class="tab-pane" id="page">
                    @if(is_null($unit->child))

                    @else
                        <div role="tabpanel" class="tab-pane active" id="ad">
                        <h2>
                            @if(! is_null($unit->child->name))
                                <strong>{{ $unit->child->name }}</strong>
                            @else
                                <em>Untitled</em>
                            @endif
                        </h2>
                        <a href="{{ route('units.edit', ['unit' => $unit->child]) }}">Edit</a>

                        <hr>

                        <p><strong>Created at:</strong> {{ $unit->child->created_at->toDayDateTimeString() }}</p>
                        <p><strong>Last updated at:</strong> {{ $unit->child->updated_at->toDayDateTimeString() }}</p>
                        
                        @if(is_null($unit->child->template))
                            <p>No template selected yet.</p>
                        @else
                            <p><strong>Template:</strong> {{ $unit->child->template->name }}</p>
                            <p><strong>Components contained:</strong></p>
                            
                            <!-- Components -->
                            @if($unit->child->template->components->count() > 0)
                            <ul class="list-group">
                                @foreach($unit->child->template->components as $component)
                                    <li class="list-group-item">
                                        <h5><strong>{{ $component->name }}</strong></h5>
                                        @if(! empty($unit->child->components[$component->slug]))
                                            <p>{{ $unit->child->components[$component->slug] }}</p>
                                        @else
                                            <p><em>Not defined yet.</em></p>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                            @else
                                <em>No components contained.</em>
                            @endif
                        @endif

                        <hr>
                        <p><strong>PREVIEW</strong></p>
                        <iframe id="rederer-iframe" src="{{ route('units.render', ['unit' => $unit->child, 'nullable' => 'y']) }}" frameborder="0" width="960" height="540"></iframe>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
