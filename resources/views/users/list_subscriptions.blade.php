@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>
                Subscriptions
            </h1>
            <hr>
            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table table-striped table-bordered table-hover">
                        <tr>
                        <th class="text-center">Name</th>
                        <th class="text-center">Expiry</th>
                        <th class="text-center">Days</th>
                        <th class="text-center">Allowed Videos</th>
                        <th class="text-center">Allowed Scroll Over</th>
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
                            
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
