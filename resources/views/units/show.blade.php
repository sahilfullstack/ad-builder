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

                    <create-unit-copy-button :unit="{{ $unit->toJson() }}" redirect-to="{{ route('units.list')}}"></create-unit-copy-button>
                    <hr>
                    @if(is_null($unit->approved_at))
                    <a href="{{ route('units.edit', ['unit' => $unit]) }}" class="btn btn-sm btn-info">Edit</a>&nbsp;
                    @endif
                    <delete-unit-button :unit="{{ $unit->toJson() }}" redirect-to="{{ route('units.list')}}"></delete-unit-button>
                    <hr>

                    @if( ! is_null($unit->scheduled_at))
                    <p><strong>Scheduled at:</strong> {{ $unit->scheduled_at->toDayDateTimeString() }}</p>
                    @endif
                    @if( ! is_null($unit->thumbnail))
                    <p><strong>Thumbnail:</strong> <a href="{{ $unit->thumbnail }}">{{ $unit->thumbnail }}</a></p>
                    @endif
                    @if( ! is_null($unit->hover_image))
                    <p><strong>Hover Image:</strong> <a href="{{ $unit->hover_image }}">{{ $unit->hover_image }}</a></p>
                    @endif
                    @if($unit->is_popup == 0)
                    <p><strong>Popup:</strong>Disabled</p>
                    @else
                    <p><strong>Popup:</strong>Enabled</p>
                    @endif
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
                                    @if(! empty($unit->components[$component->id]))
                                        
                                        <p>{{ $unit->components[$component->id]["_value"] }}</p>
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
                        @if(is_null($unit->approved_at))
                        <a href="{{ route('units.edit', ['unit' => $unit->child]) }}">Edit</a>
                        @endif
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
                                        @if(! empty($unit->child->components[$component->id]))
                                            @if($component->type == 'images')
                                                <p>{{ $unit->child->components[$component->id][0]["_value"] }}</p>
                                            @elseif($component->type == 'hours_of_operation')
                                                @if(is_null($unit->child->components[$component->id]["_value"]["title"]))
                                                    <p>Title: <strong>{{$unit->child->components[$component->id]["_value"]["title"]}}</strong></p>
                                                @endif
                                                <table style=" font-family: arial, sans-serif; border-collapse: collapse; width: 100%;">
                                                    <tr>
                                                        <th style="border: 1px solid #dddddd; text-align: left; padding: 8px;">Day</th>
                                                        <th style="border: 1px solid #dddddd; text-align: left; padding: 8px;">Open</th>
                                                        <th style="border: 1px solid #dddddd; text-align: left; padding: 8px;">Close</th>
                                                    </tr>
                                                        @foreach($unit->child->components[$component->id]["_value"]["values"] as $key => $values)
                                                        <tr>
                                                            @foreach($values as $key => $value)
                                                                <td style="border: 1px solid #dddddd; text-align: left; padding: 8px;"><strong>{{$value['_value']}}</strong></td>
                                                            @endforeach
                                                        </tr>
                                                        @endforeach
                                                </table> 
                                            @elseif($component->type == 'survey')
                                                @if(! is_null($unit->child->components[$component->id]["_value"]["title"]["_value"]))
                                                    <p>Title: <strong>{{$unit->child->components[$component->id]["_value"]["title"]["_value"]}}</strong></p>
                                                @endif

                                                @if(! is_null($unit->child->components[$component->id]["_value"]["question"]["_value"]))
                                                    <p>Question: <strong>{{$unit->child->components[$component->id]["_value"]["question"]["_value"]}}</strong></p>
                                                @endif
                                            @elseif($component->type == 'timeline')
                                                @if(is_null($unit->child->components[$component->id]["_value"]["title"]))
                                                    <p>Title: <strong>{{$unit->child->components[$component->id]["_value"]["title"]}}</strong></p>
                                                @endif
                                                <table style=" font-family: arial, sans-serif; border-collapse: collapse; width: 100%;">
                                                    <tr>
                                                        <th style="border: 1px solid #dddddd; text-align: left; padding: 8px;">Year</th>
                                                        <th style="border: 1px solid #dddddd; text-align: left; padding: 8px;">Image</th>
                                                        <th style="border: 1px solid #dddddd; text-align: left; padding: 8px;">Month</th>
                                                        <th style="border: 1px solid #dddddd; text-align: left; padding: 8px;">Description</th>
                                                    </tr>
                                                        @foreach($unit->child->components[$component->id]["_value"]["values"] as $key => $values)
                                                        <tr>
                                                            @foreach($values as $key => $value)
                                                                <td style="border: 1px solid #dddddd; text-align: left; padding: 8px;"><strong>{{$value}}</strong></td>
                                                            @endforeach
                                                        </tr>
                                                        @endforeach
                                                </table>
                                            @else
                                                <p>{{ $unit->child->components[$component->id]["_value"] }}</p>
                                            @endif
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
