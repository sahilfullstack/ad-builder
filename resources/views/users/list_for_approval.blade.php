@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>
                Users
            </h1>
            <hr>

            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table table-striped table-bordered table-hover">
                        <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Company</th>
                        <th class="text-center">Phone</th>
                        <th class="text-center">Username</th>
                        <th class="text-center">Registered at</th>
                        <th class="text-center">Actions</th>
                        <!-- <th class="text-center">Reject</th> -->
                        </tr>
                    @foreach($users as $key => $user)
                        <tr>
                        <td>{{$key + 1}}</td>
                        <td><span class="badge">{{ $user->role->name }}</span> {{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->company}}</td>
                        <td>{{$user->phone}}</td>
                        <td>{{$user->username}}</td>
                        <td>{{$user->created_at->toDayDateTimeString()}}</td>
                        <td>
                            @if(is_null($user->approved_at) && is_null($user->rejected_at))
                                <create-user-approve-button :user="{{ $user->toJson() }}"></create-user-approve-button>
                                <create-user-reject-button :user="{{ $user->toJson() }}"></create-user-reject-button>
                            @elseif( ! is_null($user->approved_at))
                               <a href="{{ route('users.manage.subscriptions', [
                                'user' => $user->id
                               ]) }}">
                                    Manage Subscription
                                </a>
                            @endif
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
