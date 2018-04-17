@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add New Unit</h1>
    <hr>
    
    <div class="row">
        <div class="col-md-3">
            <ul class="nav nav-pills nav-stacked unit-wizard-sidebar" data-spy="affix" data-offset-top="200">
                <li class="{{ $section == 'template' ? 'active' : ''}}">
                    <a href="{{ route('units.edit', ['unit' => $unit, 'section' => 'template']) }}">1. Choose Template</a>
                </li>
                <li class="{{ $section == 'components' ? 'active' : ''}}">
                    <a href="{{ route('units.edit', ['unit' => $unit, 'section' => 'components']) }}">2. Customize Ad</a>
                </li>
                <li class="{{ $section == 'basic' ? 'active' : ''}}">
                    <a href="{{ route('units.edit', ['unit' => $unit, 'section' => 'basic']) }}">3. Ad Name</a>
                </li>
            </ul>
        </div>
        <div class="col-md-9">
            <img src="http://mesa.metaworthy.com/storage/sample-template.jpg" class="img-responsive" style="padding: 50px;">

            <hr>

            <div class="panel panel-default">
                <div class="panel-body">
                    @if($section == 'template')
                        <edit-unit-template-form
                            redirect-to="{{ route('units.edit', ['unit' => $unit, 'section' => 'components']) }}"
                            :unit="{{ $unit->toJson() }}"
                            :templates="{{ $data['templates']->toJson() }}">
                        </edit-unit-template-form>
                    @elseif($section == 'components')
                        <edit-unit-components-form
                            redirect-to="{{ route('units.edit', ['unit' => $unit, 'section' => 'basic']) }}"
                            :unit="{{ $unit->load('template.components')->toJson() }}"
                            :components="{{ $data['components']->toJson() }}">
                        </edit-unit-components-form>
                    @elseif($section == 'basic')
                        <edit-unit-basic-form
                            redirect-to="{{ route('units.list') }}"
                            :unit="{{ $unit->toJson() }}">
                        </edit-unit-basic-form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
