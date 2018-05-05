@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>
                Subscriptions
            </h1>
            <hr>
            @if($subscriptions->count() > 0)
            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table table-striped table-bordered table-hover">
                        <tr>
                        <th class="text-center">Name</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Expiring At</th>
                        <th class="text-center">Allowed Quantity</th>
                        </tr>
                    @foreach($subscriptions as $subscription)
                            <tr>
                            <td>{{$subscription->layout->name}}</td>
                            <td>Active</td>
                            <td>{{\Carbon\Carbon::parse($subscription->expiring_at)->toDayDateTimeString()}}</td>
                            <td>{{$subscription->allowed_quantity}}</td>
                            </tr>
                    @endforeach
                    </table>
                </div>
            </div>
            @else
                <span>No subscriptions yet</span>
            @endif
        </div>
    </div>
</div>
@endsection
