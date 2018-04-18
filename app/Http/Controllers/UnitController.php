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

        $units = Unit::notDeleted()->with(['template', 'template.components'])
        ->where('user_id', auth()->user()->id)
        ->whereHas('template', function($query) use ($type) {
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

    public function edit(Unit $unit)
    {
        $section = request()->input('section');

        // If no or invalid type was passed, we would move to creating an ad.
        if (is_null($section) || !in_array($section, ['template', 'components', 'basic'])) {
            return redirect(route('units.edit', ['unit' => $unit, 'section' => 'template']));
        }

        $data = $this->{"dataToEdit$section"}($unit);

        return view('units.edit', array_merge(compact('data'), compact('unit', 'section')));
    }

    private function dataToEditTemplate(Unit $unit)
    {
        $templates = Template::whereType('ad')->with('components')->get();
        
        return ['templates' => $templates];
    }

    private function dataToEditComponents(Unit $unit)
    {
        return ['components' => $unit->template->components];
    }

    private function dataToEditBasic(Unit $unit)
    {
        return [];
    }

    public function listUnitsForApproval()
    {
      $units = Unit::notDeleted()->with(['template', 'template.components'])
        ->whereNotNull('published_at')
        ->whereNull('approved_at')
        ->whereNull('rejected_at')
        ->whereHas('template')
        ->latest()->paginate();

        return view('units.list_for_approval', compact('units'));
    }
}
