<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Template;
use App\Models\Layout;

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
        $templates = Template::notDeleted()->with('components')->latest()->paginate();

        return view('templates.home', compact('templates'));
    }

    public function create()
    {
        $layouts = Layout::notDeleted()->latest()->get();

        return view('templates.create', compact('layouts'));
    }
}
