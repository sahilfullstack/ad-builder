<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unit;

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

    public function embed()
    {
        return view('practice.embed');
    }
}
