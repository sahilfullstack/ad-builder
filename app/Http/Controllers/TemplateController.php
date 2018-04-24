<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Template;
use App\Models\Layout;
use App\Http\Requests;

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
    public function list(Requests\ListTemplatesRequest $request)
    {
        $templates = Template::notDeleted()->with('components', 'layout')->latest()->paginate();
        return view('templates.home', compact('templates'));
    }

    public function create(Requests\CreateTemplateRequest $request)
    {
        $layouts = Layout::notDeleted()->latest()->get();

        return view('templates.create', compact('layouts'));
    }

    public function show(Template $template)
    {        
        return view('templates.show', compact('template'));
    }
}
