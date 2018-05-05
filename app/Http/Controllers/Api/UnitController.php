<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Template, Component, Unit};
use App\Http\Requests\{ListUnitRequest, StoreUnitRequest, UpdateUnitRequest, PublishUnitRequest, ApproveUnitRequest};

use App\Exceptions\{InvalidInputException, CustomInvalidInputException};
use Carbon\Carbon;
use App\Models\Layout;

use App\Rules\ValidComponents;
use App\Services\Formatter\Formatter;

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

    public function list(ListUnitRequest $request)
    {
        $units = Unit::notDeleted()->with(['template', 'template.components']);
      
        if( ! is_null($request->get('type')))
        {
            $units = $units->where('type', $request->get('type'));
        }

        if( ! is_null($request->get('ids')))
        {
            $units = $units->whereIn('id', explode(',', $request->get('ids')));
        }

        $units = $units->get()->toArray();

        $formatter = Formatter::make($units, Formatter::ARR);

        return $this->returnResponseToSpecificFormat($formatter, $request->get('responseFormat'));
    }    

    private function returnResponseToSpecificFormat($formatter, $format)
    {
        $response = null;
        switch ($format) {
            case 'xml':
                $response = $formatter->toXml();
                break;
            case 'json':
                $response = $formatter->toJson();
                break;
            case 'array':
                $response = $formatter->toArray();
                break;
            
            default:
                # code...
                break;
        }
        return response($response, 200);
    }       

    public function show(Unit $unit, Request $request)
    {
        $units = Unit::notDeleted()->with(['template', 'template.components'])
                ->where([
                    'type'=> 'ad',
                    'id' => $unit->id
                    ])
                ->first()->toArray();

        $formatter = Formatter::make($units, Formatter::ARR);

        return $this->returnResponseToSpecificFormat($formatter, $request->get('responseFormat'));
    }

    public function publish(PublishUnitRequest $request, Unit $unit)
    {        
        // Validating that the selected template has the selected components.
        if(is_null($unit->name))
        {
            throw new CustomInvalidInputException('parent_name', 'Name is empty.');
        }        

        if(is_null($unit->template_id))
        {
            throw new CustomInvalidInputException('parent_template', 'Template is empty.');
        }

        if(is_null($unit->layout_id))
        {
            throw new CustomInvalidInputException('parent_layout', 'Layout is empty.');
        }

        $template = Template::find($unit->template_id);

        // Validating that the selected template has the selected components.
        if($template->components->count() != count($unit->components))
        {
            throw new CustomInvalidInputException('parent_components', 'Components are missing.');
        }

        foreach ($unit->components as $key => $component) 
        {
            if(empty($component))
            {                     
                throw new CustomInvalidInputException('parent_components', 'Components are missing.');
            }
        }

        $childUnit = Unit::where('parent_id', $unit->id)->first();

        $this->validateChildUnit($childUnit);

        $unit->published_at = Carbon::now();
        $unit->save();

        return $unit->fresh();
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

    public function update(UpdateUnitRequest $request, Unit $unit)
    {
        // if layout is sent
        if (!is_null($request->layout_id))
        {
            // validating if user has subscription
            $this->hasSubscription($unit->user, $request->layout_id);   

            $unit->layout_id = $request->layout_id;
        }

        // if template is sent
        if( ! is_null($request->template_id))
        {
            $unit->template_id = $request->template_id;            
    
            $template = Template::notDeleted()->find($request->template_id);

            if(count($unit->components) == 0)
            {
                $templeteComponents = $template->components()->get();   
                $preparedComponents = $this->preparedBlankComponents($templeteComponents);
                $unit->components = $preparedComponents;
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
                    $unit->components = $preparedComponents;
                }
            }
        }
        
        // if name is sent
        if(! is_null($request->name))
        {
            $unit->name = $request->name;
        }  

        // if parent_id is sent
        if(! is_null($request->parent_id))
        {
            $unit->parent_id = $request->parent_id;
        } 

        $unit->save();

        return $unit->fresh();
    }

    private function preparedComponents($inputComponents, $templateComponents)
    {
        $preparedComponents = [];
        foreach($templateComponents as $component)
        {
            $preparedComponents[$component->id] = [
                '_value' => $inputComponents[$component->id]
            ];
        }

        return $preparedComponents;
    }    

    private function preparedBlankComponents($templateComponents)
    {
        $preparedComponents = [];
        foreach($templateComponents as $component)
        {
            $preparedComponents[$component->id] = '';
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

    private function hasSubscription($user, $layoutId)
    {
        $subscription = $user->subscriptions
            ->where('layout_id', $layoutId)
            ->where('expiring_at', '>', Carbon::now())
            ->where('allowed_quantity', '>', 0)
            ->first();

        if( ! is_null($subscription))
        {
            throw new InvalidInputException("Subscription is invalid.");
        }   
    }
}
