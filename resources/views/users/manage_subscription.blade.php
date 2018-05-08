@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>
                Manage Subscriptions
            </h1>
            <hr>
            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table table-striped table-bordered table-hover">
                        <tr>
                            <th class="text-center">Name</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Registered at</th>
                        </tr>
                        <tr>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->created_at->toDayDateTimeString()}}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span class="h3">Subscriptions</span> <add-subscription-button :user="{{ $user->toJson() }}" :layouts="{{ $layouts->toJson() }}"></add-subscription-button>
                </div>
                <div class="panel-body">
                @if($subscriptions->count() > 0)
                    <table class="table table-striped table-bordered table-hover">
                        <tr>
                        <th class="text-center">Name</th>
                        <th class="text-center">Expiry</th>
                        <th class="text-center">Allowed Quantity</th>
                        <!-- <th class="text-center">Update</th> -->
                        <!-- <th class="text-center">Reject</th> -->
                        </tr>
                    @foreach($user->subscriptions as $subscription)
                            <tr>
                            <td>{{$subscription->layout->name}}</td>
                            <td>{{\Carbon\Carbon::parse($subscription->expiring_at)->toDayDateTimeString()}}</td>
                            <td>{{$subscription->allowed_quantity}}</td>
                            <!-- <td><update-user-subscription-button :user="{{ $user->toJson() }}" :subscription="{{ $subscription->toJson() }}" ></update-user-subscription-button></td> -->
                            </tr>
                    @endforeach
                    </table>               
                @else
                    <span>No subscriptions yet</span>
                @endif
                 </div>
            </div>
        </div>
    </div>
</div>
@endsection
