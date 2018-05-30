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
                            <th class="text-center">Is Active?</th>
                        </tr>
                        <tr>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->created_at->toDayDateTimeString()}}</td>
                            <td>{{ $user->active ? 'Yes' : 'No' }}</td>
                        </tr>
                    </table>
                </div>
                <div class="panel-footer">
                    <delete-user-button :user="{{ $user->toJson() }}"></delete-user-button>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span class="h3">Subscriptions</span>
                    {{-- <add-subscription-button :user="{{ $user->toJson() }}" :layouts="{{ $layouts->toJson() }}"></add-subscription-button> --}}
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered table-hover">
                        <tr>
                        <th class="text-center">Name</th>
                        <th class="text-center">Expiry</th>
                        <th class="text-center">Allowed Quantity</th>
                        <th class="text-center">Days</th>
                        <th class="text-center">Allowed Videos</th>
                        <th class="text-center">Allowed Hover</th>
                        <th class="text-center">Allowed Popout</th>
                        <!-- <th class="text-center">Update</th> -->
                        <!-- <th class="text-center">Reject</th> -->
                        </tr>
                    @foreach($layouts as $layout)
                            <tr>
                            <td>{{$layout->name}}</td>
                            <td>{{
                                is_null($subscription = $subscriptions->where('layout_id', $layout->id)->first())
                                ? 'NA' 
                                : \Carbon\Carbon::parse($subscription->expiring_at)->toDayDateTimeString()
                            }}</td>
                            <td>{{
                                is_null($subscription = $subscriptions->where('layout_id', $layout->id)->first())
                                ? 'NA'
                                : $subscription->allowed_quantity
                            }}</td>
                            <td>{{
                                is_null($subscription = $subscriptions->where('layout_id', $layout->id)->first())
                                ? 'NA'
                                : $subscription->days
                            }}</td>
                            <td>{{
                                is_null($subscription = $subscriptions->where('layout_id', $layout->id)->first())
                                ? 'NA'
                                : ($subscription->allow_videos ? 'Yes' : 'No')
                            }}</td>

                            <td>{{
                                is_null($subscription = $subscriptions->where('layout_id', $layout->id)->first())
                                ? 'NA'
                                : ($subscription->allow_hover ? 'Yes' : 'No')
                            }}</td>

                            <td>{{
                                is_null($subscription = $subscriptions->where('layout_id', $layout->id)->first())
                                ? 'NA'
                                : ($subscription->allow_popout ? 'Yes' : 'No')
                            }}</td>

                            <td>
                                <update-user-subscription-button
                                    :user="{{ $user->toJson() }}"
                                    :subscription="{{ is_null($subscription = $subscriptions->where('layout_id', $layout->id)->first()) ? '{}' : $subscription->toJson() }}" 
                                    :layout="{{ $layout->toJson() }}"    
                                >

                                </update-user-subscription-button></td>
                            </td>
                            
                            </tr>
                    @endforeach
                    </table>               
                 </div>
            </div>
        </div>
    </div>
</div>
@endsection
