<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Template;
use App\Models\Unit;

class UnitController extends Controller
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

    public function list()
    {
        $type = request()->input('type');

        // If no or invalid type was passed, we would move to creating an ad.
        if (is_null($type) || !in_array($type, ['ad', 'page'])) {
            return redirect(route('units.list', ['type' => 'ad']));
        }

        $units = Unit::notDeleted()->with(['template', 'template.components'])->whereHas('template', function($query) use ($type) {
            $query->where('type', $type);
        })->latest()->paginate();

        return view('units.home', compact('units', 'type'));
    }

    public function create()
    {
        $type = request()->input('type');

        // If no or invalid type was passed, we would move to creating an ad.
        if(is_null($type) || ! in_array($type, ['ad', 'page']))
        {
            return redirect(route('units.create', ['type' => 'ad']));
        }

        $templates = Template::whereType($type)->with('components')->get();

        return view('units.create', compact('type', 'templates'));
    }
}
