@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>
                Statistical Data
            </h1>
            <div class="panel panel-default">
                <div class="panel-body">
                    <filter-form path="/statistics/average" from="{{ $from }}" to="{{ $to }}"></filter-form>
                    <!-- <date-picker v-model="time" range lang="en"></date-picker> -->
                </div>
            </div>
            <hr>
            <div class="panel panel-default">
                <div class="panel-body">
                    @if($type == 'daterange')
                        <area-chart :data="{{ json_encode($range) }}"></area-chart>
                    @elseif($type == 'pie')
                        <pie-chart :data="{{ json_encode($range) }}"></pie-chart>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
