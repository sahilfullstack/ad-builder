@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h1>Add New Template</h1>
            <hr>

            <div class="panel panel-default">
                <div class="panel-body">
                    <create-template-form after-create-path="{{ route('templates.list') }}"></create-template-form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
