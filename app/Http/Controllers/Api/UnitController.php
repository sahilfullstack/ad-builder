<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Template;
use App\Models\Component;
use App\Models\Unit;
use App\Http\Requests\{StoreUnitRequest, UpdateUnitRequest};
use App\Exceptions\InvalidInputException;

class UnitController extends Controller
{
    public function store(StoreUnitRequest $request)
    {
        // Blank unit is created
        $unit = new Unit([
            'user_id' => auth()->user()->id,
            'components' => []
        ]);

        $unit->save();

        return $unit->fresh();
    }

    public function update($unitId, UpdateUnitRequest $request)
    {
        $unitFound = Unit::find($unitId);

        $inputComponents = $request->components;

        // if template is sent
        if( ! is_null($request->template_id))
        {
            $unitFound->template_id = $request->template_id;            
    
            $template = Template::find($request->template_id);

            if( ! is_null($request->components))
            {
                $inputComponents = $request->components;
                $components = $template->components()->whereIn('id', array_keys($inputComponents))->get();

                // Validating that the selected template has the selected components.
                if($components->count() != count($inputComponents))
                {
                    throw InvalidInputException('Bad components sent.');
                }
        
                $preparedComponents = $this->preparedComponents($inputComponents, $components);
             
                if(count($preparedComponents > 0))
                {
                    $unitFound->components = $preparedComponents;
                }
            }
        }
        
        // if name is sent
        if(! is_null($request->name))
        {
            $unitFound->name = $request->name;
        } 

        $unitFound->save();

        return $unitFound->fresh();
    }

    private function preparedComponents($inputComponents, $templateComponents)
    {
        $preparedComponents = [];
        foreach($templateComponents as $component)
        {
            $preparedComponents[$component->slug] = $inputComponents[$component->id];
        }

        return $preparedComponents;

    }
}
