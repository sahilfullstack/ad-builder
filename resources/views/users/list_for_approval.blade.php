@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h1>
                Approve or Reject Users 
            </h1>
            <hr>

            @if($users->count() > 0)
            <table class="table" >
                <tr>
                <th class="text-center">S.no</th>
                <th class="text-center">Name</th>
                <th class="text-center">Email</th>
                <th class="text-center">Registration Date</th>
                <th class="text-center">Approve</th>
                <th class="text-center">Reject</th>
                </tr>
            @foreach($users as $key => $user)
                <tr class="active">
                <td>{{$key}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->created_at}}</td>
                <td><create-user-approve-button :user="{{ $user->toJson() }}"></create-user-approve-button></td>
                <td><create-user-reject-button :user="{{ $user->toJson() }}"></create-user-reject-button></td>
                </tr>
            @endforeach
            @else
                <em>No user to accept or reject.</em>
            @endif
            </table>
        </div>
    </div>
</div>
@endsection
