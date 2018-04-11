@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add New Unit</h1>
    <hr>
    
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-body">
                    <create-unit-form type="{{ $type }}" :templates="{{ $templates->toJson() }}"></create-unit-form>
                </div>

            </div>
        </div>
        <div class="col-md-6">
            Preview will appear here (COMING SOON).
        </div>
    </div>
</div>
@endsection
