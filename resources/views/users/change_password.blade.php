@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>
                Change Password
            </h1>
            <hr>
            <div class="panel panel-default">
                <div class="panel-body">
                    <update-user-password-form
                        after-create-path="{{ route('dashboard') }}">
                    </update-user-password-form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
