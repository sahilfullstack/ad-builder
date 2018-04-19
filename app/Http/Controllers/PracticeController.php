<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TemplateController extends Controller
{
    public function template1()
    {
        return view('practice.templates.1');
    }
}
