<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Template, Component, Unit};
use App\Http\Requests\{ListUnitRequest, StoreUnitRequest, UpdateUnitRequest, PublishUnitRequest, ApproveUnitRequest};

use App\Exceptions\{InvalidInputException, CustomInvalidInputException};
use Carbon\Carbon, DB;
use App\Models\{Layout, Subscription};

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
        try
        {
            DB::beginTransaction();

            // if layout is sent
            if (!is_null($request->layout_id))
            {
                // validating if user has subscription
                $this->hasSubscription($unit, $request->layout_id);   
                
                if( is_null($unit->redeemed_subscription_id))
                {
                    $subscription = Subscription::where([
                            'layout_id' => $request->layout_id,
                            'user_id' => $unit->user->id
                            ])
                    ->whereRaw('allowed_quantity > redeemed_quantity')->orderBy('expiring_at', 'DESC')->first();

                    $subscription->redeemed_quantity = $subscription->redeemed_quantity+1;
                    $unit->redeemed_subscription_id = $subscription->id;
                    
                    $subscription->save();

                    $unit->layout_id = $request->layout_id;
                }
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
                    $unit->components   = $preparedComponents;
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

                    $this->validateComponents($inputComponents, $template->id);

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
            
            DB::commit();   
            return $unit->fresh();
        }
        catch(\Exception $e)
        {
            DB::rollBack();

        }
    }

    private function preparedComponents($inputComponents, $templateComponents)
    {
        $preparedComponents = [];
        foreach($templateComponents as $component)
        {
            $preparedComponents[$component->id] = $inputComponents[$component->id];
        }

        return $preparedComponents;
    }    

    private function preparedBlankComponents($templateComponents)
    {
        $preparedComponents = [];
        foreach($templateComponents as $component)
        {
            if($component->type == "survey")
            {
                $preparedComponents[$component->id] = ['_value' => '', '_yes' => 0, '_no' => 0 ];
            }
            else
            {                  
                $preparedComponents[$component->id] = ['_value' => ''];
            }
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

            $validator = \Validator::make([$component->name => $value['_value']], [
                 $component->name => [
                    'required',
                ]

            ]);

            if($component->type == "color")
            {
                $validator = \Validator::make([$component->name => $value['_value']], [
                     $component->name => [
                        'regex:/^(\#[\da-f]{3}|\#[\da-f]{6}|rgba\(((\d{1,2}|1\d\d|2([0-4]\d|5[0-5]))\s*,\s*){2}((\d{1,2}|1\d\d|2([0-4]\d|5[0-5]))\s*)(,\s*(0\.\d+|1))\)|hsla\(\s*((\d{1,2}|[1-2]\d{2}|3([0-5]\d|60)))\s*,\s*((\d{1,2}|100)\s*%)\s*,\s*((\d{1,2}|100)\s*%)(,\s*(0\.\d+|1))\)|rgb\(((\d{1,2}|1\d\d|2([0-4]\d|5[0-5]))\s*,\s*){2}((\d{1,2}|1\d\d|2([0-4]\d|5[0-5]))\s*)|hsl\(\s*((\d{1,2}|[1-2]\d{2}|3([0-5]\d|60)))\s*,\s*((\d{1,2}|100)\s*%)\s*,\s*((\d{1,2}|100)\s*%)\))$/i',
                    ]
                ]);
            }

            foreach ($component->rules as $ruleKey => $ruleValue)
            {
                // $name = $component->name;
                $validator->addRules([
                    $component->name => [
                        new ValidComponents($component->type, $ruleKey, $ruleValue)
                    ]
                ]);
            }

            if ($validator->fails()) {
                throw new InvalidInputException($validator->errors()->first());
            }
        }
    }

    private function hasSubscription($unit, $layoutId)
    {
        $user = $unit->user;
        $userId = $unit->id;
        $subscription = $user->subscriptions
            ->where('layout_id', $layoutId)
            ->where('expiring_at', '>', Carbon::now())
            ->first();

        if(is_null($subscription) or (($subscription->allowed_quantity - $subscription->redeemed_quantity) <= 0))
        {
            throw new InvalidInputException("Subscription is invalid.");
        }
    }
}
