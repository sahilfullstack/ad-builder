<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Template;

class TemplateController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * List all the templates.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $templates = Template::notDeleted()->with('components')->paginate();

        return view('templates.home', compact('templates'));
    }
}
