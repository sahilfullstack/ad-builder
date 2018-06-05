@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h5>{{ $user->name }} <span class="badge badge-dark">{{ $user->type_human }}</span></h5></div>

                <div class="panel-body">
                    <p><strong>Registered at:</strong> {{ $user->created_at->toDayDateTimeString() }}</p>
                    <p><strong>Last updated at:</strong> {{ $user->updated_at->toDayDateTimeString() }}</p>
                    
                    @if(! is_null($user->email))
                        <p><strong>Email:</strong> {{ $user->email }}</p>
                    @endif                    
                    @if(! is_null($user->company))
                        <p><strong>Company:</strong> {{ $user->company }}</p>
                    @endif                    
                    @if(! is_null($user->phone))
                        <p><strong>Phone:</strong> {{ $user->phone }}</p>
                    @endif                    
                    @if(! is_null($user->address))
                        <p><strong>Address:</strong> {{ $user->address }}</p>
                    @endif                    
                    @if(! is_null($user->city))
                        <p><strong>City:</strong> {{ $user->city }}</p>
                    @endif                    
                    @if(! is_null($user->state))
                        <p><strong>State:</strong> {{ $user->state }}</p>
                    @endif                    
                    @if(! is_null($user->pin))
                        <p><strong>Pin:</strong> {{ $user->pin }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection