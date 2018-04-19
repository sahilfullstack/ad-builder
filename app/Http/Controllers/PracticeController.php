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

    public function embed()
    {
        return view('practice.embed');
    }
}
