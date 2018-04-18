@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
             <h1>
                Templates 
                @if(Auth::user()->can('template.manage'))
                   <a href="{{ route('templates.create') }}" class="btn btn-primary btn-sm">Add New</a>
                @endif 
             </h1>
            <hr>

            @foreach($templates as $template)
                <div class="panel panel-default">
                    <div class="panel-heading"><h5>{{ $template->name }} <span class="badge badge-dark">{{ $template->type_human }}</span></h5></div>

                    <div class="panel-body">
                        <p><strong>Created at:</strong> {{ $template->created_at->toDayDateTimeString() }}</p>
                        <p><strong>Last updated at:</strong> {{ $template->updated_at->toDayDateTimeString() }}</p>
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
            @endforeach
        </div>
    </div>
</div>
@endsection
