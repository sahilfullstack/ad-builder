<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unit;
use App\Services\SlideMaker\Canvas;
use App\Services\SlideMaker\Element;
use App\Models\Layout;

class PracticeController extends Controller
{
    public function template1()
    {
        $unit = Unit::find(25);
        return view('practice.templates.1', compact('unit'));
    }

    public function renderTemplate(Request $request, $template)
    {
        $bodyClass = '';
        if(! is_null($request->query('z'))) $bodyClass = 'two-x';
        $unit = Unit::find(1);
        $readableComponents = $unit->readable_components;
        return view("templates.renderers.$template", compact('bodyClass', 'readableComponents', 'unit'));
    }

    public function slides()
    {
        $canvas = new Canvas(1920, 1080);

        $contents = collect(str_split(Layout::find(6)->contents));
        
        $contentLayouts = Layout::findMany($contents);
        
        foreach($contents as $index => $content)
        {
            $layout = $contentLayouts->find($content);

            $canvas->fitElement(new Element($layout->width, $layout->height, random_int(1, 5)));
        }

        return view('templates.renderers.full-page-combo', compact('canvas'));

        foreach($canvas->getOrigins() as $origin)
        {
            var_dump($origin->getPositionTop(), $origin->getPositionLeft(), $origin->getElement()->getPixelWidth(), $origin->getElement()->getPixelHeight());
        }
    }

    public function embed()
    {
        return view('practice.embed');
    }
}
