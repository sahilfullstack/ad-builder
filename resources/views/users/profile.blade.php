@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>
                Profile
            </h1>
            <hr>
            <div class="panel panel-default">
                <div class="panel-body">
                    <update-user-profile-form
                        :user="{{ $user->toJson() }}">
                    </update-user-profile-form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
