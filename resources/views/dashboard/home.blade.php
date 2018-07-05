@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <!-- <img src="http://mesa.metaworthy.com/storage/dashboard.png" class="img-responsive" style="padding: 50px;"> -->
            <h1>
                Pinned Reports
            </h1>
            @if (count($reports) >= 1)
                <div class="panel panel-default">
                    <div class="panel-body">
                        <filter-form path="{{ $path }}" from="{{ $from }}" to="{{ $to }}" :filters="{{ json_encode($filters) }}"></filter-form>
                    </div>
                </div>
            	@foreach($reports as $key => $report)
                    
                    <div class="panel panel-default">
                       <div class="panel-body">
                            <b>{{$key+1}}. {{ ucwords(str_replace(['-', '_'], ' ', $report[6]))}}</b>  <create-unpinned-report-button :pinned="{{ $report[8]->toJson() }}" report="{{ $report[6] }}" :filters="{{ json_encode($filters) }}"></create-unpinned-report-button>
                            <br>
                            @if($report[0] == 'daterange')
                                @foreach($report[5] as $filter)
                                    @if($filter['slug'] == 'unit_id')
                                        Ad -
                                        @if($filter['selected'] == null)
                                        Not Selected
                                        @else
                                        {{\App\Models\Unit::find($filter['selected'])->name}}
                                        @endif      
                                    @else
                                        {{ucwords(str_replace(['-', '_', 'id'], ' ', $filter['slug']))}} - 
                                        @if($filter['selected'] == null)
                                            Not Selected
                                        @else
                                            {{$filter['selected']}}
                                        @endif                   
                                    @endif                                                
                                    <br>
                                @endforeach                           
                            @endif
                        </div>
                        <div class="panel-body">
                            @if($report[0] == 'daterange')
                                <area-chart :data="{{ json_encode($report[1]) }}" label="{{$report[7]}}" xtitle="date" ytitle="{{$report[7]}}" :legend="true"></area-chart>
                            @elseif($report[0] == 'pie')
                                <pie-chart :data="{{ json_encode($report[1]) }}"></pie-chart>
                            @endif
                        </div>
                    </div>
                    <hr>
            	@endforeach
            @else
            	<p> No pinned reports </p>
            @endif
        </div>
    </div>
</div>
@endsection
