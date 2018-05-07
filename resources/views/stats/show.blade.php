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
                    <area-chart :data="{{ json_encode($range) }}"></area-chart>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
