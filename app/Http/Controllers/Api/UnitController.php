<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Template, Component, Unit};
use App\Http\Requests\{StoreUnitRequest, UpdateUnitRequest, PublishUnitRequest, ApproveUnitRequest};
use App\Exceptions\{InvalidInputException, CustomInvalidInputException};
use Carbon\Carbon;
use App\Models\Layout;

use App\Rules\ValidComponents;

class UnitController extends Controller
{
    public function store(StoreUnitRequest $request)
    {
        // Blank unit is created
        $unit = new Unit([
            'user_id'    => auth()->user()->id,
            'type'       => $request->type,
            'components' => []
        ]);

        if($request->has('parent_id'))
        {
            $parent = Unit::notDeleted()->find($request->parent_id);

            if(is_null($parent)) throw new InvalidInputException('Invalid parent unit passed.');

            $unit->parent_id = $parent->id;
        }

        $unit->save();

        return $unit->fresh();
    }    

    public function publish($unitId, PublishUnitRequest $request)
    {
        $unitFound = Unit::find($unitId);
        
        // Validating that the selected template has the selected components.
        if(is_null($unitFound->name))
        {
            throw new CustomInvalidInputException('parent_name', 'Name is empty.');
        }        

        if(is_null($unitFound->template_id))
        {
            throw new CustomInvalidInputException('parent_template', 'Template is empty.');
        }

        if(is_null($unitFound->layout_id))
        {
            throw new CustomInvalidInputException('parent_layout', 'Layout is empty.');
        }

        $template = Template::find($unitFound->template_id);

        // Validating that the selected template has the selected components.
        if($template->components->count() != count($unitFound->components))
        {
            throw new CustomInvalidInputException('parent_components', 'Components are missing.');
        }

        foreach ($unitFound->components as $key => $component) 
        {
            if(empty($component))
            {                     
                throw new CustomInvalidInputException('parent_components', 'Components are missing.');
            }
        }

        $childUnit = Unit::where('parent_id', $unitId)->first();

        $this->validateChildUnit($childUnit);

        $unitFound->published_at = Carbon::now();
        $unitFound->save();

        return $unitFound->fresh();
    }

    private function validateChildUnit($unit)
    {
        // Validating that the selected template has the selected components.
        if(is_null($unit->name))
        {
            throw new CustomInvalidInputException('name', 'Name is empty.');
        }        

        if(is_null($unit->template_id))
        {
            throw new CustomInvalidInputException('template', 'Template is empty.');
        }

        $template = Template::find($unit->template_id);

        // Validating that the selected template has the selected components.
        if($template->components->count() != count($unit->components))
        {
            throw new CustomInvalidInputException('components', 'Components are missing.');
        }

        foreach ($unit->components as $key => $component) 
        {
            if(empty($component))
            {                     
                throw new CustomInvalidInputException('components', 'Components are missing.');
            }
        }
    }

    public function update($unitId, UpdateUnitRequest $request)
    {
        $unitFound = Unit::find($unitId);

        $inputComponents = $request->components;

        // if layout is sent
        if (!is_null($request->layout_id))
        {
            $unitFound->layout_id = $request->layout_id;
        }

        // if template is sent
        if( ! is_null($request->template_id))
        {
            $unitFound->template_id = $request->template_id;            
    
            $template = Template::notDeleted()->find($request->template_id);

            if(count($unitFound->components) == 0)
            {
                $templeteComponents = $template->components()->get();   
                $preparedComponents = $this->preparedBlankComponents($templeteComponents);
                $unitFound->components = $preparedComponents;
            }

            if( ! is_null($request->components))
            {
                $inputComponents = $request->components;

                $components = $template->components()->whereIn('id', array_keys($inputComponents))->get();


                // Validating that the selected template has the selected components.
                if($components->count() != count($inputComponents))
                {
                    throw new InvalidInputException('Bad components sent.');
                }

                $this->validateComponents($request->components, $template->id);                
        
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

        // if parent_id is sent
        if(! is_null($request->parent_id))
        {
            $unitFound->parent_id = $request->parent_id;
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

    private function preparedBlankComponents($templateComponents)
    {
        $preparedComponents = [];
        foreach($templateComponents as $component)
        {
            $preparedComponents[$component->slug] = '';
        }

        return $preparedComponents;
    }

    public function approve($unitId, ApproveUnitRequest $request)
    {
        $unitFound = Unit::find($unitId);

        if($request->action == 'approve') 
        {
            $unitFound->approved_at = Carbon::now();                
        }
        else 
        {
            $unitFound->rejected_at = Carbon::now();
        }

        $unitFound->save();

        return $unitFound->fresh();
    }

    private function validateComponents($components, $templateId)
    {
        foreach ($components as $componentId => $value) 
        {
            $component = Component::find($componentId);

            foreach ($component->rules as $ruleKey => $ruleValue)
            {
                $name = $component->slug;
                
                $validator = \Validator::make([$name => $value], [
                    $name => [
                        'required',
                        new ValidComponents($component->type, $ruleKey, $ruleValue)
                    ]
                ]);

                if ($validator->fails()) {
                    throw new InvalidInputException($validator->errors()->first());
                }
            }
        }
    }
}
