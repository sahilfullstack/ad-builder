@extends('layouts.app')

@section('content')
<div class="container-fluid">
    
    <div class="row">
        <div class="col-md-3" style="background: #fff; padding: 20px; height: 800px; margin-top: -22px;">
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
            
            @if(is_null($unit->template) || is_null($unit->template->renderer))
                <img src="http://mesa.metaworthy.com/storage/sample-template.jpg" class="img-responsive" style="padding: 50px;">
            @else
                <iframe id="rederer-iframe" src="{{ route('units.render', compact('unit')) }}" frameborder="0" width="960" height="540"></iframe>
            @endif
            <hr>

            <div class="panel panel-default">
                <div class="panel-body">
                    @if($section == 'ad')
                        <edit-unit-ad-form
                            redirect-to="{{ $unit->nextSectionEditRoute($section) }}"
                            :unit="{{ $unit->toJson() }}"
                            :ads="{{ $data['ads']->toJson() }}">
                        </edit-unit-ad-form>
                    @elseif($section == 'layout')
                        <edit-unit-layout-form
                            redirect-to="{{ $unit->nextSectionEditRoute($section) }}"
                            :unit="{{ $unit->toJson() }}"
                            :layouts="{{ $data['layouts']->toJson() }}">
                        </edit-unit-layout-form>
                    @elseif($section == 'template')
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
                    @elseif($section == 'hoverimage')
                        <edit-unit-hoverimage-form
                            redirect-to="{{ $unit->nextSectionEditRoute($section) }}"
                            :unit="{{ $unit->toJson() }}">
                        </edit-unit-hoverimage-form>
                    @elseif($section == 'thumbnail')
                        <edit-unit-thumbnail-form
                            redirect-to="{{ $unit->nextSectionEditRoute($section) }}"
                            :unit="{{ $unit->toJson() }}">
                        </edit-unit-thumbnail-form>
                    @elseif($section == 'page')
                        <edit-unit-landing-page-form
                            redirect-to="{{ $unit->nextSectionEditRoute($section) }}"
                            :unit="{{ $unit->toJson() }}">
                        </edit-unit-landing-page-form>
                    @elseif($section == 'submit')
                        <edit-unit-submit-form
                            redirect-to="{{ $unit->nextSectionEditRoute($section) }}"
                            :unit="{{ $unit->toJson() }}">
                        </edit-unit-basic-form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var frameElement = document.getElementById("renderer-iframe");
    if(frameElement) frameElement.contentWindow.location.href = frameElement.src;
</script>
@endsection
