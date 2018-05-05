<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Template;
use App\Models\Unit;
use App\Models\Layout;
use App\Http\Requests\{ListUnitRequestForApproval, ShowUnitRequest, EditUnitRequest};
use Carbon\Carbon, DB;
use Exception;

class UnitController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    public function list()
    {
        $type = request()->input('type');

        // If no or invalid type was passed, we would move to creating an ad.
        if (is_null($type) || !in_array($type, ['ad', 'page'])) {
            return redirect(route('units.list', ['type' => 'ad']));
        }

        $units = Unit::notDeleted()->with(['template', 'template.components']);

        if( ! auth()->user()->can('unit.manage'))
        {
            $units = $units->where('user_id', auth()->user()->id);
        }

        $units = $units->where('type', $type)
        ->latest()->paginate();

        return view('units.home', compact('units', 'type'));
    }

    public function show(ShowUnitRequest $request, Unit $unit)
    {
        $unit->load('child', 'template.components');
        
        return view('units.show', compact('unit'));
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

    public function edit(EditUnitRequest $request, Unit $unit)
    {
        $section = request()->input('section');

        // If no or invalid type was passed, we would move to creating an ad.
        $validSections = array_pluck(Unit::$sections[$unit->type], 'slug');
        if (is_null($section) || !in_array($section, $validSections)) {
            return redirect(route('units.edit', ['unit' => $unit, 'section' => head($validSections)]));
        }

        try
        {
            $data = $this->{"dataToEdit$section"}($unit);
        }
        catch(Exception $e)
        {
            return redirect(route('units.edit', ['unit' => $unit, 'section' => 'layout']));
        }

        return view('units.edit', array_merge(compact('data'), compact('unit', 'section')));
    }

    public function render(Unit $unit)
    {
        if(request()->input('nullable', 'n') == 'y')
        {
            if(is_null($unit->template) || is_null($unit->template->renderer))
            {
                return view('templates.renderers.null');
            }
        }

        return view($unit->template->renderer, compact('unit'));
    }

    private function dataToEditLayout(Unit $unit)
    {
        $userId = $unit->user->id;

        $layoutIds = DB::select(DB::raw("Select s.layout_id from subscriptions as s join (select layout_id, count(layout_id) as count from units where user_id=$userId and deleted_at is null and layout_id is not NULL GROUP BY `layout_id`) as a ON a.layout_id = s.layout_id WHERE s.user_id = $userId and a.count < s.allowed_quantity;"));

        $layouts = Layout::whereIn('id', array_pluck($layoutIds, 'layout_id'))->notDeleted()->get();

        return ['layouts' => $layouts];
    }

    private function dataToEditTemplate(Unit $unit)
    {
        if(is_null($unit->layout_id))
        {
            throw new Exception('Layout not selected yet.');
        }

        $query = Template::notDeleted()
            ->whereType($unit->type)
            ->where('layout_id', $unit->layout_id)
            ->with('components');
        
        return ['templates' => $query->get()];
    }

    private function dataToEditComponents(Unit $unit)
    {
        return ['components' => $unit->template->components];
    }

    private function dataToEditBasic(Unit $unit)
    {
        return [];
    }

    
    private function dataToEditAd(Unit $unit)
    {
        return ['ads' => auth()->user()->units('ad')->get()];
    }
    
    private function dataToEditSubmit(Unit $unit)
    {
        return [];
    }
    
    private function dataToEditPage(Unit $unit)
    {
        return [];
    }

    public function editLandingPage(EditUnitRequest $request, Unit $unit)
    {
        // only ads can have page
        if($unit->type != 'ad')
        {
            return redirect(route('units.list'));
        }
        
        // only user's own ads can have pages
        if($unit->user->id != auth()->user()->id)
        {
            return redirect(route('units.list'));
        }

        // ad has page existing already
        if(! is_null($unit->child))
        {
            $child = $unit->child;
        }
        else
        {
            $child = new Unit([
                'user_id' => auth()->user()->id,
                'type' => 'page',
                'parent_id' => $unit->id,
                'components' => []
            ]);

            $child->save();

            $child->fresh();
        }

        return redirect(route('units.edit', ['unit' => $child->id, 'section' => 'template']));
    }
    
    public function listUnitsForApproval(ListUnitRequestForApproval $request)
    {

      $units = Unit::notDeleted()->with(['template', 'template.components'])
        ->whereNotNull('published_at')
        ->whereNull('approved_at')
        ->whereNull('rejected_at')
        ->whereHas('template')
        ->where('type', 'ad')
        ->latest()->paginate();

        return view('units.list_for_approval', compact('units'));
    }
}
