<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Template, Unit, Layout, Subscription};

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
        // // query to make sure only those layouts are available for which the user has a subscription
        $userId = $unit->user->id;

        $layouts = DB::select(DB::raw("select sum(allowed_quantity - redeemed_quantity) as available_quantity, layouts.* from subscriptions join layouts on subscriptions.layout_id = layouts.id where subscriptions.user_id = $userId and subscriptions.expiring_at >= now() group by subscriptions.layout_id having available_quantity > 0;"));

        // this is done so that unit could be edited, 
        // the layout cant be changed though from the backend.
        if(! is_null($unit->layout_id) and empty($layouts))
        {
            $layouts = [$unit->layout_id];
        }
        else
        {
            $layouts  = array_pluck($layouts, 'id');
        }

        $layouts = Layout::whereIn('id', $layouts)->notDeleted()->get();

        return ['layouts' => $layouts];
    }

    private function dataToEditTemplate(Unit $unit)
    {
        if($unit->type == 'ad' && is_null($unit->layout_id))
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

    private function dataToEditHoverImage(Unit $unit)
    {
        return [];
    }

    private function dataToEditThumbnail(Unit $unit)
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
            $layout = Layout::notDeleted()->whereSlug('full-page')->first();

            $child = new Unit([
                'user_id' => auth()->user()->id,
                'type' => 'page',
                'layout_id' => is_null($layout) ? null : $layout->id,
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
