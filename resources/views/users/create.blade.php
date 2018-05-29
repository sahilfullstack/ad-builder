@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h1>Add New User</h1>
            <hr>

            <div class="panel panel-default">
                <div class="panel-body">
                    <create-user-form
                        after-create-path="{{ route('users.list') }}">
                    </create-user-form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
