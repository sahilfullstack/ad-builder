@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>
                Approve or Reject Units 
            </h1>
            <hr>
            @if($units->count() > 0)
           
            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table table-striped table-bordered table-hover">
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Landing Page</th>
                            <th class="text-center">Created at</th>
                            <th class="text-center">Action</th>
                        </tr>

                        @foreach($units as $index => $unit)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <a href="{{ route('units.show', $unit) }}">
                                        @if(! is_null($unit->name))
                                            <strong>{{ $unit-> name }}</strong>
                                        @else
                                            <em>Untitled</em>
                                        @endif
                                    </a></td>
                                <td>
                                    @if(! is_null($unit->child))
                                        @if(! is_null($unit->child->name))
                                            <strong>{{ $unit->child->name }}</strong>
                                        @else
                                            <em>Untitled</em>
                                        @endif
                                    @else
                                        <em>None yet.</em>
                                    @endif
                                </td>
                                <td>
                                    {{ $unit->created_at->toDayDateTimeString() }}
                                </td>
                                <td>
                                    <create-approve-button :unit="{{ $unit->toJson() }}"></create-approve-button>
                                    <create-reject-button :unit="{{ $unit->toJson() }}"></create-reject-button>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div class="panel-footer">
                    {{ $units->links() }}
                </div>
            </div>

            {{-- @foreach($units as $unit)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5>{{ $unit->name }} <span class="badge badge-dark">{{ $unit->template->type_human }}</span></h5>
                        <create-approve-button :unit="{{ $unit->toJson() }}"></create-approve-button>
                        <create-reject-button :unit="{{ $unit->toJson() }}"></create-reject-button>
                    </div>

                    <div class="panel-body">
                        <p><strong>Created at:</strong> {{ $unit->created_at->toDayDateTimeString() }}</p>
                        <p><strong>Last updated at:</strong> {{ $unit->updated_at->toDayDateTimeString() }}</p>
                        
                        @if(! is_null($unit->parent))
                        <p><strong>Against ad:</strong> {{ $unit->parent->name }}</p>
                        @endif
                        
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
                                        @if(isset($unit->components[$component->slug]))
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
                    </div>                   
                </div>
            @endforeach --}}
            @else
                <em>No units yet.</em>
            @endif
        </div>
    </div>
</div>
@endsection
