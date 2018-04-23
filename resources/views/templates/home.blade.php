@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
             <h1>
                Templates 
                @if(Auth::user()->can('template.manage'))
                   <a href="{{ route('templates.create') }}" class="btn btn-primary btn-sm">Add New</a>
                @endif 
             </h1>
            <hr>

            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table table-striped table-bordered table-hover">
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Layout</th>
                            <th class="text-center">Preview Renderer</th>
                            <th class="text-center">Components</th>
                            <th class="text-center">Created at</th>
                        </tr>

                        @foreach($templates as $index => $template)
                            <tr>
                                <td>{{ $index +1 }}</td>
                                <td><span class="badge badge-dark">{{ $template->type_human }}</span> <a href="{{ route('templates.show', $template) }}"><strong>{{ $template->name }}</strong></a></td>
                                <td>
                                    @if(! is_null($template->layout))
                                        {{ $template->layout->name }}
                                    @endif
                                </td>
                                <td>
                                    @if(! is_null($template->renderer))
                                        {{ $template->renderer }}
                                    @endif
                                </td>
                                <td>
                                    @if($template->components->count() > 0)
                                        {{ $template->components->implode('name', ', ') }}
                                    @else
                                        <em>None yet.</em>
                                    @endif
                                </td>
                                <td>
                                    {{ $template->created_at->toDayDateTimeString() }}
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>

            {{-- @foreach($templates as $template)
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
            @endforeach --}}
        </div>
    </div>
</div>
@endsection
