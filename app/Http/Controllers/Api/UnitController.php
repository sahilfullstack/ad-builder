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
use Illuminate\Support\Str;
use App\Services\SlideMaker\Element;
use App\Services\SlideMaker\Canvas;

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
        $units = Unit::published()->approved()->with(['category', 'layout', 'child', 'template.components'])->orderBy('layout_id');
        
        if( ! is_null($request->get('type')))
        {
            $units = $units->where('type', $request->get('type'));
        }

        if( ! is_null($request->get('ids')))
        {
            $units = $units->whereIn('id', explode(',', $request->get('ids')));
        }

        $units = $units->get()->toArray();
        
        $formatter = Formatter::make($this->transformUnitsForKiosk($units), Formatter::ARR);
        
        return $this->returnResponseToSpecificFormat($formatter, $request->get('responseFormat'));
    }

    protected function transformUnitsForKiosk($units)
    {
        /*
            <PRODUCT> 
                <product>
                    <prid>105</prid>
                    <detailimage>Full Page Landing Templates_1920x1080_v2-16.jpg</detailimage>
                    <assets>URL1,URL2,URL3,URL4</assets>
                    <thumbnail>Ad-Pages05Thumb.jpg</thumbnail>
                    <category>Upgrades</category>
                    <title>MESA: Upgrades</title>
                    <slideimage>http://mesa.metaworthy.com/practice/templates/full-page-ad-templates_1920x1080-02?z=2</slideimage>
                <slidelayoutid>0</slidelayoutid>
                    <startchar>M</startchar>
                    <hoverimage>Transparent.png</hoverimage>
                </product>
            </PRODUCT>
        */

        $transformed = $this->fitInSlides($units);
        
        
        foreach($units as $unit)
        {
            $transformed[]['product'] = [
                'hash' => md5($unit['updated_at'] . $unit['child']['updated_at']),
                'prid' => $unit['id'],
                'category_id' => $unit['category']['id'],
                'category' => $unit['category']['name'],
                'title' => $unit['name'],
                'assets' => implode(',', $this->findAssetUrls($unit)),
                'render_url' => route('units.render', [$unit['id'], 'z' => '2', 'relative' => 'y']),
                'landing_page_url' => route('units.render', [$unit['child']['id'], 'z' => '2', 'relative' => 'y']),
                'layout_id' => $unit['layout_id'] - 1,
                'startchar' => Str::upper(substr($unit['name'], 0, 1)),
                'thumbnail' => is_null($unit['thumbnail']) ? 'Ad-Pages-5.jpeg' : $unit['thumbnail'],
                'hoverimage' => is_null($unit['hover_image']) ? 'Transparent.png' : $unit['hover_image'],
            ];
        }
        return $transformed;
    }

    protected function findAssetUrls($unit)
    {
        $assets = [];

        foreach($unit['components'] as $componentId => $componentValue)
        {
            $component = Component::find($componentId);
            if(
                in_array($component->type, ['image', 'video', 'audio'])
                &&
                ! empty($componentValue['_value'])
            )
            {
                $assets[] = $componentValue['_value'];
            }
            else if(
                in_array($component->type, ['images'])
            )
            {
                foreach($componentValue as $componentIndex => $componentIndexValue)
                {
                    if(! empty($componentIndexValue['_value']))
                    $assets[] = $componentIndexValue['_value'];
                }
            }
        }
        return $assets;
    }

    protected function fitInSlides($units)
    {
        $processedUnits = [];
        $slides = [];
        
        $i = 0;
        while (count($processedUnits) < count($units)) {
            $slides[] = [
                'slide' => [
                    'slideadjustment' => $this->fitInSlide($units, $processedUnits)
                ]
            ];
            $i++;
        }
        return $slides;
    }

    protected function fitInSlide($units, &$processedUnits)
    {
        $selectedUnits = [];

        $canvas = new Canvas(1920, 1080);
        foreach ($units as $index => $unit) {
            if (! in_array($unit['id'], $processedUnits)) {
                $wasFit = $canvas->fitElement(new Element($unit['layout']['width'], $unit['layout']['height'], $unit['id']));

                if ($wasFit) {
                    array_push($processedUnits, $unit['id']);
                    array_push($selectedUnits, $unit['id']);
                }
            }
        }

        return implode(',', $selectedUnits);
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

        $subscription = $this->getRedeemedSubscription($unit);

        $unit->redeemed_subscription_id = $subscription->id;
        $unit->published_at = Carbon::now();
        $unit->save();

        return $unit->fresh();
    }

    private function getRedeemedSubscription($unit)
    {
        $userId     = $unit->user_id;
        $layoutId   = $unit->layout_id;
        $templateId = $unit->template_id;

        $layouts = DB::select(
            DB::raw(
                "select 
                    sum(allowed_quantity - redeemed_quantity) 
                        as available_quantity, 
                    layouts.* 

                    from subscriptions 

                    join layouts on 
                        subscriptions.layout_id = layouts.id 

                    where subscriptions.user_id = $userId 
                    and 
                    subscriptions.expiring_at >= now() 
                    and 
                    layouts.id=$layoutId

                    group by 
                        subscriptions.layout_id 
                    having available_quantity > 0;
                ")
            );

        if(count($layouts) < 1 )
        {
            throw new CustomInvalidInputException('general', 'Subscription Doesnot exist. Please contact the admin at admin@mesa.com');
        }

        $componentsWithVideo = Component::where('template_id', $templateId)
                            ->where('type', 'video')
                            ->get();

        if(count($componentsWithVideo) > 0)
        {
            $subscription = Subscription::where('user_id', $userId)
                            ->where('layout_id', $layoutId)
                            ->whereRaw('allowed_quantity > redeemed_quantity')
                            ->whereRaw('expiring_at >= now()')
                            ->where('allow_videos', 1)
                            ->orderBy('expiring_at', 'DESC')->first();

            if(is_null($subscription))
            {
                throw new CustomInvalidInputException('general', 'Cannot use video element of this subscription. Please contact the admin at admin@mesa.com');
            }
        }

        $subscription->redeemed_quantity = $subscription->redeemed_quantity+1;            
        $subscription->save();
            
        return $subscription;
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
                $unit->layout_id = $request->layout_id;
            }

            // if template is sent
            if( ! is_null($request->template_id))
            {
                $template = Template::notDeleted()->find($request->template_id);
                
                
                if($unit->template_id != $request->template_id)
                {
                    // Update unit's template id.
                    $unit->template_id = $request->template_id;
                    
                    // Seed blank components.
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
            if(! is_null($request->category_id))
            {
                $unit->category_id = $request->category_id;
            } 

            // if parent_id is sent
            if(! is_null($request->parent_id))
            {
                $unit->parent_id = $request->parent_id;
            }

            // if hover_image is sent
            if(! is_null($request->hover_image))
            {
                $this->validateImage($request->hover_image, 'hover_image');

                $unit->hover_image = $request->hover_image;
            } 

            // if thumbnail is sent
            if(! is_null($request->thumbnail))
            {
                $this->validateImage($request->thumbnail, 'thumbnail');

                $unit->thumbnail = $request->thumbnail;
            } 

            $unit->save();
            
            DB::commit();   
            return $unit->fresh();
        }
        catch(CustomInvalidInputException $e)
        {
            throw $e;
        }
        catch(\Exception $e)
        {
            DB::rollBack();
            throw $e;

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
            else if($component->type == 'images')
            {
                $preparedComponents[$component->id] = [['_value' => '']];
            }
            else if($component->type == 'text')
            {
                $preparedComponents[$component->id] = ['_value' => '', 'background_color' => '#ffffff', 'foreground_color' => '#000000', 'size' => 12];
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

            if($component->type == 'images')
            {
                $validator = \Validator::make([$component->name => $value], [
                     $component->name . '.*._value' => [
                        'required',
                    ]
                ]);
            }
            else if($component->type == "color")
            {
                $validator = \Validator::make([$component->name => $value['_value']], [
                     $component->name => [
                        'regex:/^(\#[\da-f]{3}|\#[\da-f]{6}|rgba\(((\d{1,2}|1\d\d|2([0-4]\d|5[0-5]))\s*,\s*){2}((\d{1,2}|1\d\d|2([0-4]\d|5[0-5]))\s*)(,\s*(0\.\d+|1))\)|hsla\(\s*((\d{1,2}|[1-2]\d{2}|3([0-5]\d|60)))\s*,\s*((\d{1,2}|100)\s*%)\s*,\s*((\d{1,2}|100)\s*%)(,\s*(0\.\d+|1))\)|rgb\(((\d{1,2}|1\d\d|2([0-4]\d|5[0-5]))\s*,\s*){2}((\d{1,2}|1\d\d|2([0-4]\d|5[0-5]))\s*)|hsl\(\s*((\d{1,2}|[1-2]\d{2}|3([0-5]\d|60)))\s*,\s*((\d{1,2}|100)\s*%)\s*,\s*((\d{1,2}|100)\s*%)\))$/i',
                    ]
                ]);
            }
            else
            {
                $validator = \Validator::make([$component->name => $value['_value']], [
                    $component->name => [
                        'required',
                    ]
                ]);
            }

            if($component->type == 'images')
            {
                $validator->addRules([
                    $component->name . '.*._value' => [
                        'url',
                        'regex:/^' . preg_quote(url()->to('/'), '/') . '/'
                    ]
                ]);
                $validator->setCustomMessages([
                    $component->name . '.*._value.regex' => 'The :attribute must be uploaded here.'
                ]);
            } else if(in_array($component->type, ['image', 'audio', 'video'])) {
                $validator->addRules([
                    $component->name => [
                        'url',
                        'regex:/^' . preg_quote(url()->to('/'), '/') . '/'
                    ]
                ]);
                $validator->setCustomMessages([
                    $component->name . '.regex' => 'The :attribute must be uploaded here.'
                ]);
            }


            foreach ($component->rules as $ruleKey => $ruleValue)
            {
                if($component->type == 'images')
                {
                    $validator->addRules([
                        $component->name . '.*._value' => [
                            new ValidComponents($component->type, $ruleKey, $ruleValue)
                        ]
                    ]);
                } else {
                    $validator->addRules([
                        $component->name => [
                            new ValidComponents($component->type, $ruleKey, $ruleValue)
                        ]
                    ]);
                }
            }

            if ($validator->fails()) {
                throw new InvalidInputException($validator->errors()->first());
            }
        }
    }

    // not using this for now
    // private function hasSubscription($unit, $layoutId)
    // {
    //     $user = $unit->user;
        
    //     $subscription = DB::table('subscriptions')
    //         ->selectRaw('sum(allowed_quantity - redeemed_quantity) as available_quantity')
    //         ->where('user_id', $user->id)
    //         ->where('layout_id', $layoutId)
    //         ->whereRaw('expiring_at >= now()')
    //         ->groupBy('layout_id')
    //         ->havingRaw('available_quantity > 0')
    //         ->first();

    //     if(is_null($subscription) or (($subscription->available_quantity) <= 0))
    //     {
    //         throw new InvalidInputException("Subscription is invalid.");
    //     }
    // }

    private function validateImage($url, $tag)
    {
        try
        {
            getImageSize($url);            
        }
        catch(\Exception $e)
        {
            throw new CustomInvalidInputException($tag, 'Image is invalid.');
        }
    }
}
