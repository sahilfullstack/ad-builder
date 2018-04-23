@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>
                Users
            </h1>
            <hr>

            <div class="panel">
                <div class="panel-body">
                    @if($users->count() > 0)
                    <table class="table table-striped table-bordered table-hover">
                        <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Registered at</th>
                        <th class="text-center">Actions</th>
                        <!-- <th class="text-center">Reject</th> -->
                        </tr>
                    @foreach($users as $key => $user)
                        <tr>
                        <td>{{$key + 1}}</td>
                        <td><span class="badge">{{ $user->role->name }}</span> {{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->created_at->toDayDateTimeString()}}</td>
                        <td>
                            <create-user-approve-button :user="{{ $user->toJson() }}"></create-user-approve-button>
                            <create-user-reject-button :user="{{ $user->toJson() }}"></create-user-reject-button>
                        </td>
                        </tr>
                    @endforeach
                    @else
                        <em>No user to accept or reject.</em>
                    @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
