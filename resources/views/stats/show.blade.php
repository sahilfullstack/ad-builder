@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>
                Statistical Data
            </h1>
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
