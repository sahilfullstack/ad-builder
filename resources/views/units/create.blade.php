@extends('layouts.app')

@section('content')
<style>
    
</style>
<div class="container">
    <h1>Add New Unit</h1>
    <hr>
    
    <div class="row">
        <div class="col-md-3">
            <ul class="nav nav-pills nav-stacked unit-wizard-sidebar" data-spy="affix" data-offset-top="200">
                <li class="active"><a href>1. Choose Template</a></li>
                {{-- <li class="active"><a href="{{ route('units.edit', ['unit_id' => $unit->id, 'part' => 'template']) }}">Section 1</a></li> --}}
                <li><a href>2. Customize Ad</a></li>
                <li><a href>3. Ad Name</a></li>
            </ul>
        </div>
        <div class="col-md-9">
            <div class="panel panel-default" style="height: 250px;">
                <div class="panel-body text-center">
                    <p style="padding: 90px;">Preview will appear here (COMING SOON).</p>
                </div>
            </div>

            <hr>

            <div class="panel panel-default">
                <div class="panel-body">
                    <create-unit-form after-create-path="{{ route('units.list') }}" type="{{ $type }}" :templates="{{ $templates->toJson() }}"></create-unit-form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
