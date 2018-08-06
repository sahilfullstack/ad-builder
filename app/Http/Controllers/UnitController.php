<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Template, Unit, Layout, Subscription, Category};

use App\Http\Requests\{ListUnitRequestForApproval, ShowUnitRequest, EditUnitRequest};
use Carbon\Carbon, DB;
use Exception;
use App\Models\Component;
use App\Services\SlideMaker\Canvas;
use App\Services\SlideMaker\Element;

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
        $filter = request()->input('filter');

        // If no or invalid type was passed, we would move to creating an ad.
        if (is_null($type) || !in_array($type, ['ad', 'page']) || !in_array($filter, ['draft', 'published', 'processing', 'approved', 'rejected', 'all', 'expired'])) {
            return redirect(route('units.list', array_merge(['type' => 'ad', 'filter'=>'all'], request()->query())));
        }

        $units = Unit::notDeleted()->noHoldees()->with(['template', 'template.components']);

        if( ! auth()->user()->can('unit.manage'))
        {
            $units = $units->where('user_id', auth()->user()->id);
        }

        if(in_array($filter, ['draft', 'published', 'processing', 'approved', 'rejected', 'expired']))
        {
            switch ($filter) {
                case 'approved':
                    $units = $units->whereNotNull('approved_at');
                    break; 
                case 'rejected':
                    $units = $units->whereNotNull('rejected_at');
                    break;

                case 'processing':
                    $units = $units->whereNotNull('published_at')
                        ->whereNull('processed_at')
                        ->whereNull('approved_at');
                    break;

                case 'published':
                    $units = $units->whereNotNull('published_at')
                    ->whereNotNull('processed_at');
                    break;  

                case 'expired':
                    $units = $units->whereNotNull('expired_at');
                    break;  

                case 'draft':
                    $units = $units->whereNull('published_at');
                    break;
                
                default:
                    # code...
                    break;
            }
            $units = $units->where('type', $type);
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

    public function recordResponse(Unit $unit, Component $component)
    {
        $response = request()->input('response');

        if($component->type != 'survey') return;
        if( ! in_array($response, ['yes', 'no'])) return;

        $updatedComponent[$component->id] = $unit->components[$component->id];
        $updatedComponent[$component->id]["_$response"] += 1;
        
        $unit->update(['components' => array_replace($unit->components, $updatedComponent)]);

        return response('', 204);
    }

    public function render(Unit $unit)
    {
        $bodyClass = '';
        if(! is_null(request()->query('z'))) $bodyClass = 'two-x';

        if($unit->is_holder)
        {
            $unit->load('holdee');
            $canvas = new Canvas(1920, 1080);
            foreach($unit->holdee as $index => $held)
            {
                $canvas->fitElement(new Element($held->layout->width, $held->layout->height, $held));
            }

            return view('templates.renderers.full-page-customizable', compact('canvas'));
        }

        if(request()->input('nullable', 'n') == 'y')
        {
            if(is_null($unit->template) || is_null($unit->template->renderer))
            {
                return view('templates.renderers.null');
            }
        }

        if(! is_null(request()->query('is_preview')))
        {
            $readableComponents = $unit->readable_experimental_components;
        } else {
            $readableComponents = $unit->readable_components;
        }

        return view($unit->template->renderer, compact('unit', 'readableComponents', 'bodyClass'));
    }

    private function dataToEditLayout(Unit $unit)
    {
        // // query to make sure only those layouts are available for which the user has a subscription
        $userId = $unit->user->id;

        // $layouts = DB::select(DB::raw("select sum(allowed_quantity - redeemed_quantity) as available_quantity, layouts.* from subscriptions join layouts on subscriptions.layout_id = layouts.id where subscriptions.user_id = $userId and subscriptions.expiring_at >= now() group by subscriptions.layout_id having available_quantity > 0;"));

        $layouts = Layout::where('parent_id', null)->get()->toArray();

        // this is done so that unit could be edited, 
        // the layout cant be changed though from the backend.
        if(! is_null($unit->layout_id) and empty($layouts))
        {
            $layouts = [$unit->layout_id];
        }
        else
        {
            $layouts = array_pluck($layouts, 'id');

            if(! is_null($unit->layout))
            {
                $layouts = array_merge($layouts, [$unit->layout_id]); 
            }
        }   

        $layouts = Layout::whereIn('id', $layouts)->with('children')->notDeleted()->get();
        return ['layouts' => $layouts];
    }

    private function dataToEditTemplate(Unit $unit)
    {
        if($unit->type == 'ad' && is_null($unit->layout_id))
        {
            throw new Exception('Layout not selected yet.');
        }

        if($unit->is_holder) {
            $templates = Template::notDeleted()
                ->whereType($unit->type)
                ->whereIn('layout_id', $unit->holdee->pluck('layout_id')->unique())
                ->with('components')
                ->get()->groupBy('layout_id');
        } else {
            $templates = Template::notDeleted()
                ->whereType($unit->type)
                ->where('layout_id', $unit->layout_id)
                ->with('components')
                ->get();
        }

        return ['templates' => $templates];
    }    

    private function dataToEditCategory(Unit $unit)
    {
        $query = new Category;
        
        return ['categories' => $query->get()];
    }

    private function dataToEditComponents(Unit $unit)
    {
        if($unit->is_holder) {
            $components = $unit->holdee->pluck('template.components', 'template_id');
        } else {
            $components = $unit->template->components;
        }
        return ['components' => $components];
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
        try {

            DB::beginTransaction();

            // only ads can have page
            if ($unit->type != 'ad') {
                return redirect(route('units.list'));
            }
            
            // only user's own ads can have pages
            if (($unit->user->id != auth()->user()->id) and ( ! auth()->user()->canOverride($unit->user))) {
                return redirect(route('units.list'));
            }

            // ad has page existing already
            if (! is_null($unit->child)) {
                $child = $unit->child;
            } else {
                $layout = Layout::notDeleted()->whereSlug('full-page')->first();

                $child = new Unit([
                    'user_id' => auth()->user()->id,
                    'type' => 'page',
                    'is_holder' => $unit->is_holder,
                    'layout_id' => $layout->id,
                    'parent_id' => $unit->id,
                    'components' => [],
                    'experimental_components' => [],
                ]);

                $child->save();

                $child->fresh();
            }

            if ($unit->is_holder) {
                foreach ($unit->holdee as $held) {
                    $layout = Layout::notDeleted()->whereSlug('full-page')->first();

                    $page = new Unit([
                        'user_id' => auth()->user()->id,
                        'type' => 'page',
                        'is_holder' => false,
                        'layout_id' => $layout->id,
                        'parent_id' => $held->id,
                        'holder_id' => $child->id,
                        'components' => [],
                        'experimental_components' => [],
                    ]);

                    $page->save();
                }
            }
            DB::commit();
            return redirect(route('units.edit', ['unit' => $child->id, 'section' => 'template']));
        } catch(\Exception $e){
            DB::rollback();

            throw $e;
        }
    }
    
    public function listUnitsForApproval(ListUnitRequestForApproval $request)
    {
      $units = Unit::notDeleted()->noHoldees()
            ->with(['template', 'template.components'])
            ->whereNotNull('published_at')
            ->whereNotNull('processed_at')
            ->whereNull('approved_at')
            ->whereNull('rejected_at')
            ->where('type', 'ad')
            ->latest()->paginate();

        return view('units.list_for_approval', compact('units'));
    }
}
