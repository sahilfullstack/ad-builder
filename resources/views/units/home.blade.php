@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>
                {{ str_plural(unit_type_human($type)) }}
                <create-unit-button type="{{ $type }}"></create-unit-button>
            </h1>
            <hr>

            <div class="panel panel-default">
                <div class="panel-body">
                        <a href="{{ route('units.list', ['type' => 'ad', 'filter' => 'draft']) }}" class="btn btn-sm btn-info">#Draft</a>&nbsp;
                        <a href="{{ route('units.list', ['type' => 'ad', 'filter' => 'published']) }}" class="btn btn-sm btn-info">#Published</a>&nbsp;
                        <a href="{{ route('units.list', ['type' => 'ad', 'filter' => 'approved']) }}" class="btn btn-sm btn-info">#Approved</a>&nbsp;
                        <a href="{{ route('units.list', ['type' => 'ad', 'filter' => 'rejected']) }}" class="btn btn-sm btn-info">#Rejected</a>&nbsp;
                        <a href="{{ route('units.list', ['type' => 'ad', 'filter' => 'processing']) }}" class="btn btn-sm btn-info">#Processing</a>&nbsp;
                        <a href="{{ route('units.list', ['type' => 'ad', 'filter' => 'all']) }}" class="btn btn-sm btn-info">#All</a>&nbsp;
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table table-striped table-bordered table-hover">
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">User</th>
                            <th class="text-center">Landing Page</th>
                            <th class="text-center">Created at</th>
                        </tr>

                        @foreach($units as $index => $unit)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <span class="badge">{{ $unit->state }}</span>
                                    <a href="{{ route('units.show', $unit) }}">
                                        @if(! is_null($unit->name))
                                            <strong>{{ $unit-> name }}</strong>
                                        @else
                                            <em>Untitled</em>
                                        @endif
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('users.show', $unit->user()->first()) }}">
                                        @if(! is_null($unit->user()->first()->name))
                                            <strong>{{ $unit->user()->first()->name }}</strong>
                                        @else
                                            <em>Untitled</em>
                                        @endif
                                    </a>
                                </td>
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
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div class="panel-footer">
                    {{ $units->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
