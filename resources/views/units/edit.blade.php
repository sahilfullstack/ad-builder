@extends('layouts.app')

@section('content')
<div class="container">
    
    <div class="row">
        <div class="col-md-3" style="background: #fff; padding: 20px; height: 800px; border-radius: 5px;">
            <ul class="nav nav-pills nav-stacked unit-wizard-sidebar" data-spy="affix" data-offset-top="200">
                @foreach(App\Models\Unit::$sections[$unit->type] as $index => $sectionItem)
                    <li class="{{ $section == $sectionItem['slug'] ? 'active' : ''}}">
                        <a href="{{ route('units.edit', ['unit' => $unit, 'section' => $sectionItem['slug']]) }}">
                            {{ $index + 1 }}. {{ $sectionItem['name'] }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="col-md-9">
            <img src="http://mesa.metaworthy.com/storage/sample-template.jpg" class="img-responsive" style="padding: 50px;">

            <hr>

            <div class="panel panel-default">
                <div class="panel-body">
                    @if($section == 'template')
                        <edit-unit-template-form
                            redirect-to="{{ $unit->nextSectionEditRoute($section) }}"
                            :unit="{{ $unit->toJson() }}"
                            :templates="{{ $data['templates']->toJson() }}">
                        </edit-unit-template-form>
                    @elseif($section == 'components')
                        <edit-unit-components-form
                            redirect-to="{{ $unit->nextSectionEditRoute($section) }}"
                            :unit="{{ $unit->load('template.components')->toJson() }}"
                            :components="{{ $data['components']->toJson() }}">
                        </edit-unit-components-form>
                    @elseif($section == 'basic')
                        <edit-unit-basic-form
                            redirect-to="{{ $unit->nextSectionEditRoute($section) }}"
                            :unit="{{ $unit->toJson() }}">
                        </edit-unit-basic-form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
