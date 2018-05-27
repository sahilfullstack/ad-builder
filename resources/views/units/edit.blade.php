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
            
            @if( ! $unit->is_holder)
                <iframe id="renderer-iframe-{{ $unit->id }}" src="{{ route('units.render', ['unit' => $unit, 'nullable' => 'y']) }}" frameborder="0" width="960" height="540"></iframe>
            @else
                <div style="position:relative;width:960px;height:540px;">
                    @php
                        $canvas = new App\Services\SlideMaker\Canvas(1920, 1080);
                        foreach($unit->holdee as $index => $held)
                        {
                            $canvas->fitElement(new App\Services\SlideMaker\Element($held->layout->width, $held->layout->height, $held));
                        }
                    @endphp
                        
                    @foreach($canvas->getOrigins() as $origin)
                        <iframe 
                        id="renderer-iframe-{{ $origin->getElement()->getContent()->id }}"
                        frameborder="0"
                        width="{{ $origin->getElement()->getPixelWidth() / 2 }}"
                        height="{{ $origin->getElement()->getPixelHeight() / 2 }}"
                        src="{{ route('units.render', array_merge(
                            ['unit' => $origin->getElement()->getContent()->id], request()->query()
                        ))}}"
                        data-meta="{{ $origin->getPositionTop() }} - {{ $origin->getPositionLeft() }}"
                        style="
                            position: absolute;
                            top: {{ $origin->getPositionTop() / 2 }}px;
                            left: {{ $origin->getPositionLeft() / 2 }}px;
                        "></iframe>
                    @endforeach
                </div>
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
                        @if($unit->is_holder)
                            <div class="panel-group" id="accordion" role="tablist" >
                            @foreach($unit->holdee as $index => $child)
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab">
                                        <h4 class="panel-title">
                                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse-{{ $child->id }}">
                                            {{ $child->layout->name }}
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapse-{{ $child->id }}" class="panel-collapse collapse {{ $index == 0 ? 'in' : ''}}" role="tabpanel">
                                        <div class="panel-body">
                                            @if($unit->holdee->get($index + 1) == null)
                                                <edit-unit-template-form
                                                    redirect-to="{{ $unit->nextSectionEditRoute($section) }}"
                                                    :unit="{{ $child->toJson() }}"
                                                    :templates="{{ $data['templates'][$child->layout_id]->toJson() }}">
                                                </edit-unit-template-form>
                                            @else
                                                <edit-unit-template-form
                                                    moving-from="collapse-{{ $child->id }}"
                                                    move-to="collapse-{{ $unit->holdee->get($index + 1)->id }}"
                                                    :unit="{{ $child->toJson() }}"
                                                    :templates="{{ $data['templates'][$child->layout_id]->toJson() }}">
                                                </edit-unit-template-form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            </div>
                        @else
                            <edit-unit-template-form
                                redirect-to="{{ $unit->nextSectionEditRoute($section) }}"
                                :unit="{{ $unit->toJson() }}"
                                :templates="{{ $data['templates']->toJson() }}">
                            </edit-unit-template-form>
                        @endif
                    @elseif($section == 'components')
                        @if($unit->is_holder)
                            <div class="panel-group" id="accordion" role="tablist" >
                            @foreach($unit->holdee as $index => $child)
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab">
                                        <h4 class="panel-title">
                                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse-{{ $child->id }}">
                                            {{ $child->layout->name }}
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapse-{{ $child->id }}" class="panel-collapse collapse {{ $index == 0 ? 'in' : ''}}" role="tabpanel">
                                        <div class="panel-body">
                                            @if($unit->holdee->get($index + 1) == null)
                                                <edit-unit-components-form
                                                    redirect-to="{{ $unit->nextSectionEditRoute($section) }}"
                                                    :unit="{{ $child->toJson() }}"
                                                    :components="{{ $data['components'][$child->template_id]->toJson() }}">
                                                </edit-unit-components-form>
                                            @else
                                                <edit-unit-components-form
                                                    moving-from="collapse-{{ $child->id }}"
                                                    move-to="collapse-{{ $unit->holdee->get($index + 1)->id }}"
                                                    :unit="{{ $child->toJson() }}"
                                                    :components="{{ $data['components'][$child->template_id]->toJson() }}">
                                                </edit-unit-components-form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            </div>
                        @else
                        <edit-unit-components-form
                            redirect-to="{{ $unit->nextSectionEditRoute($section) }}"
                            :unit="{{ $unit->load('template.components')->toJson() }}"
                            :components="{{ $data['components']->toJson() }}">
                        </edit-unit-components-form>
                        @endif
                    @elseif($section == 'category')
                        @if($unit->is_holder)
                            <div class="panel-group" id="accordion" role="tablist" >
                            @foreach($unit->holdee as $index => $child)
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab">
                                        <h4 class="panel-title">
                                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse-{{ $child->id }}">
                                            {{ $child->layout->name }}
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapse-{{ $child->id }}" class="panel-collapse collapse {{ $index == 0 ? 'in' : ''}}" role="tabpanel">
                                        <div class="panel-body">
                                            @if($unit->holdee->get($index + 1) == null)
                                                <edit-unit-category-form
                                                    redirect-to="{{ $unit->nextSectionEditRoute($section) }}"
                                                    :unit="{{ $child->toJson() }}"
                                                    :categories="{{ $data['categories']->toJson() }}">
                                                </edit-unit-category-form>
                                            @else
                                                <edit-unit-category-form
                                                    moving-from="collapse-{{ $child->id }}"
                                                    move-to="collapse-{{ $unit->holdee->get($index + 1)->id }}"
                                                    :unit="{{ $child->toJson() }}"
                                                    :categories="{{ $data['categories']->toJson() }}">
                                                </edit-unit-category-form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            </div>
                        @else
                        <edit-unit-category-form
                            redirect-to="{{ $unit->nextSectionEditRoute($section) }}"
                            :unit="{{ $unit->toJson() }}"
                            :categories="{{ $data['categories']->toJson() }}">
                        </edit-unit-category-form>
                        @endif
                    @elseif($section == 'basic')
                        @if($unit->is_holder)
                            <div class="panel-group" id="accordion" role="tablist" >
                            @foreach($unit->holdee as $index => $child)
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab">
                                        <h4 class="panel-title">
                                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse-{{ $child->id }}">
                                            {{ $child->layout->name }}
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapse-{{ $child->id }}" class="panel-collapse collapse {{ $index == 0 ? 'in' : ''}}" role="tabpanel">
                                        <div class="panel-body">
                                            @if($unit->holdee->get($index + 1) == null)
                                                <edit-unit-basic-form
                                                    redirect-to="{{ $unit->nextSectionEditRoute($section) }}"
                                                    :unit="{{ $child->toJson() }}">
                                                </edit-unit-basic-form>
                                            @else
                                                <edit-unit-basic-form
                                                    moving-from="collapse-{{ $child->id }}"
                                                    move-to="collapse-{{ $unit->holdee->get($index + 1)->id }}"
                                                    :unit="{{ $child->toJson() }}">
                                                </edit-unit-basic-form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            </div>
                        @else
                        <edit-unit-basic-form
                            redirect-to="{{ $unit->nextSectionEditRoute($section) }}"
                            :unit="{{ $unit->toJson() }}">
                        </edit-unit-basic-form>
                        @endif
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
