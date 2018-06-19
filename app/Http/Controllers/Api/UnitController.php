<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Template, Component, Unit};
use App\Http\Requests\{ListUnitRequest, StoreUnitRequest, UpdateUnitRequest, PublishUnitRequest, ApproveUnitRequest, StoreCopyUnitRequest, DeleteUnitRequest};

use App\Exceptions\{InvalidInputException, CustomInvalidInputException};
use Carbon\Carbon, DB, Mail;
use App\Models\{Layout, Subscription};

use App\Rules\ValidComponents;
use App\Services\Formatter\Formatter;
use Illuminate\Support\Str;
use App\Services\SlideMaker\Element;
use App\Services\SlideMaker\Canvas;
use Illuminate\Support\Facades\Log;
use App\Jobs\{ProcessAudioToOggFormatJob, ProcessVideoToOgvFormatJob};
use App\User, Storage;

class UnitController extends Controller
{
    public function store(StoreUnitRequest $request)
    {
        // Blank unit is created
        $unit = new Unit([
            'user_id'    => auth()->user()->id,
            'type'       => $request->type,
            'components' => [],
            'experimental_components' => [],
            'is_holder' => false,
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

    public function unsubscribe(Unit $unit, DeleteUnitRequest $request)
    {
        try
        {
            DB::beginTransaction();          

            $unit->scheduled_at             = null; 
            $unit->published_at             = null; 
            $unit->approved_at              = null; 
            $unit->redeemed_subscription_id = null; 
            $unit->processed_at             = null; 

            $unit->save();

            // $deletedUnit = $this->deletingAUnit($unit);
            
            // if( ! $unit->is_holder)
            // {
            //     $deletedUnit = $this->deletingAUnit($unit);
            // }
            // else
            // {
            //     // throw new InvalidInputException('Copy this element is not supported right now.');
            //     $parentHolder = $this->deletingAUnit($unit);

            //     $holdees = $unit->holdee();

            //     foreach ($holdees->get() as $key => $holdee) 
            //     {
            //         $this->deletingAUnit($holdee, $parentHolder->id);
            //     }


            //     $deletedUnit = $parentHolder;
            // }

            DB::commit();   

            return $unit;
        }
        catch(\Exception $e)
        {
            DB::rollBack();
            
            throw $e;
        }
    } 


    public function storeCopy(StoreCopyUnitRequest $request, Unit $unit)
    {
        try
        { 
            $copiedUnit = null;

            DB::beginTransaction();           
    
            if( ! $unit->is_holder)
            {
                $copiedUnit = $this->creatingACopy($unit);
            }
            else
            {
                // throw new InvalidInputException('Copy this element is not supported right now.');
                $parentHolder = $this->creatingACopy($unit);

                $holdees = $unit->holdee();

                foreach ($holdees->get() as $key => $holdee) 
                {
                    $this->creatingACopy($holdee, $parentHolder->id);
                }


                $copiedUnit = $parentHolder;
            }

            DB::commit();   

            return $copiedUnit;
        }
        catch(\Exception $e)
        {
            DB::rollBack();
            throw $e;
        }
    } 

    private function creatingACopy($unit, $holderId =  null)
    {
        // creating a unit
        $unitCopy = new Unit;
        $unitCopy->name = "Copy of ".$unit->name;
        $unitCopy->template_id = $unit->template_id;
        $unitCopy->layout_id = $unit->layout_id;
        $unitCopy->components = $unit->components;
        $unitCopy->experimental_components = is_null($unit->experimental_components) ? [] : $unit->experimental_components;
        $unitCopy->user_id = $unit->user_id;
        $unitCopy->type = $unit->type;
        $unitCopy->parent_id = null;
        $unitCopy->is_holder = $unit->is_holder;
        $unitCopy->holder_id = $holderId;
        $unitCopy->thumbnail = $unit->thumbnail;
        $unitCopy->hover_image = $unit->hover_image;
        $unitCopy->category_id = $unit->category_id;

        $unitCopy->save();

        $childHolderId = null;
        if(! is_null($holderId))
        {
            $childHolderId = Unit::where('parent_id', $holderId)->first()->id;
        }

        $child = Unit::where('parent_id', $unit->id)->first();
        $unitCopyChild = new Unit;
        $unitCopyChild->name = $child->name;
        $unitCopyChild->template_id = $child->template_id;
        $unitCopyChild->layout_id = $child->layout_id;
        $unitCopyChild->components = $child->components;
        $unitCopyChild->experimental_components = is_null($child->experimental_components) ? [] : $child->experimental_components;
        $unitCopyChild->user_id = $child->user_id;
        $unitCopyChild->type = $child->type;
        $unitCopyChild->parent_id = $unitCopy->id;
        $unitCopyChild->is_holder = $unitCopy->is_holder;
        $unitCopyChild->holder_id =  $childHolderId;
        $unitCopyChild->thumbnail = $child->thumbnail;
        $unitCopyChild->hover_image = $child->hover_image;
        $unitCopyChild->category_id = $child->category_id;

        $unitCopyChild->save();

        return $unitCopy->fresh();
    }

    private function deletingAUnit($unit, $holderId =  null)
    {
        // deleting a unit
        $unit->delete();

        $child = Unit::where('parent_id', $unit->id)->first();
        if($child)
        {
            $child->delete();
        }

        return $unit->fresh();
    }

    public function list(ListUnitRequest $request)
    {
        $units = Unit::unexpired()->published()->approved()->noHoldees()->with(['holdee', 'category', 'layout', 'template', 'child', 'holdee.holdee', 'holdee.category', 'holdee.layout', 'holdee.template', 'holdee.child'])->orderBy('is_holder', 'desc')->orderBy('layout_id');
        
        if( ! is_null($request->get('type')))
        {
            $units = $units->where('type', $request->get('type'));
        }

        if( ! is_null($request->get('ids')))
        {
            $units = $units->whereIn('id', explode(',', $request->get('ids')));
        }
        $units = $units->get()->toArray();
        
        foreach($units as $index => $unit)
        {
            if($unit['is_holder']) array_splice($units, $index, 1, $unit['holdee']);
        }
        
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
            $user = User::find($unit['user_id']);
            $transformed[]['product'] = [
                'hash' => md5(file_get_contents(base_path() . '/resources/views/' . str_replace('.', '/', $unit['template']['renderer']) . '.blade.php')
                        . $unit['updated_at']
                        . $unit['child']['updated_at']),
                'prid' => $unit['id'],
                'category_id' => $unit['category']['id'],
                'category' => $unit['category']['name'],
                'title' => $unit['name'],
                'company_name' => $user->company,
                'render_url' => route('units.render', [$unit['id'], 'z' => '2', 'relative' => 'y']),
                'landing_page_url' => route('units.render', [$unit['child']['id'], 'z' => '2', 'relative' => 'y']),
                'layout_id' => $unit['layout_id'] - 1,
                'startchar' => Str::upper(substr($user->company, 0, 1)),
                'thumbnail' => is_null($unit['thumbnail']) ? 'Ad-Pages-5.jpeg' : str_replace(Storage::url(config('uploads.folder'))."/", '', $unit['thumbnail']),
                'hoverimage' => is_null($unit['hover_image']) ? 'Transparent.png' : str_replace(Storage::url(config('uploads.folder'))."/", '', $unit['hover_image']),
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
            $fit = explode('--', $this->fitInSlide($units, $processedUnits));
            $slides[] = [
                'slide' => [
                    'slideadjustment' => $fit[0],
                    'origins' => $fit[1],
                ]
            ];
            $i++;
        }
        return $slides;
    }

    protected function fitInSlide($units, &$processedUnits)
    {
        $selectedUnits = [];
        $selectedUnitsOrigins = [];

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
        
        foreach($canvas->getOrigins() as $index => $origin)
        {
            array_push($selectedUnitsOrigins, $origin->getPositionTop() . ':' . $origin->getPositionLeft());
        }
        
        return implode(',', $selectedUnits) . '--' . implode(',', $selectedUnitsOrigins);
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
                ->first();

        if( ! is_null($units))
        {
            $units = $units->toArray();            
        }
        else
        {
            $units = [];
        }

        $formatter = Formatter::make($units, Formatter::ARR);
    
        return $this->returnResponseToSpecificFormat($formatter, $request->get('responseFormat'));
    }

    public function publish(PublishUnitRequest $request, Unit $unit)
    {        
        if($unit->is_holder) {
            foreach ($unit->holdee as $held) {
                $this->validateChildUnit($held, 'parent_');
                $this->validateChildUnit($held->child);
            }
        } else {
            $this->validateChildUnit($unit, 'parent_');
            $this->validateChildUnit($unit->child);
        }

        $subscription = $this->getRedeemedSubscription($unit);

        $unit->redeemed_subscription_id = $subscription->id;
        $unit->scheduled_at = Carbon::parse($request->scheduled_at);
        // if want to perform some actions
        $this->dispatchRequiredJobsBeforePublishing($unit);

        $unit->published_at = Carbon::now();
        $unit->save();
        
        return $unit->fresh();
    }

    private function dispatchRequiredJobsBeforePublishing($unit)
    {
        if($unit->is_holder) {
            foreach ($unit->holdee as $held) {
                $this->dispatchJobForVideoAndAudioConversion($held);
                $this->dispatchJobForVideoAndAudioConversion($held->child);
            }
        } else {
            $this->dispatchJobForVideoAndAudioConversion($unit);
            $this->dispatchJobForVideoAndAudioConversion($unit->child);
        } 
    }

    private function getRedeemedSubscription($unit)
    {
        $userId     = $unit->user_id;
        $layoutId   = $unit->layout_id;
        $templateId = $unit->template_id;

        if($unit->layout->hasParent()) $layoutId = $unit->layout->parent->id;

        $subscription = Subscription::active()->where('user_id', $userId)
            ->where('layout_id', $layoutId)
            ->first();

        if(is_null($subscription) || $subscription->days == 0)
        {
            throw new CustomInvalidInputException('general', 'You do not have a subscription to publish this ad. Please contact the admin.');
        }

        $componentsWithVideoCount = Component::where('template_id', $templateId)
            ->where('type', 'video')
            ->count();

        if($componentsWithVideoCount > 0 && ! $subscription->allow_videos)
        {
            throw new CustomInvalidInputException('general', 'You do not have a subscription to use video components. Please contact the admin.');
        }

        if( ! is_null($unit->hover_image) // user has entered the hover image
            &&
            ! ($subscription->allow_hover || $subscription->allow_popout) // but has neither of these two features
        )
        {
            throw new CustomInvalidInputException('general', 'You do not have a subscription to use hover image. Please contact the admin.');
        }
    
        return $subscription;
    }

    private function validateChildUnit($unit, $prefix = '')
    {
        // Validating that the selected template has the selected components.
        if(is_null($unit->name))
        {
            throw new CustomInvalidInputException($prefix.'name', 'Name is empty.');
        }        

        if(is_null($unit->layout_id))
        {
            throw new CustomInvalidInputException($prefix.'layout', 'Layout is empty.');
        }

        if(is_null($unit->template_id))
        {
            throw new CustomInvalidInputException($prefix.'template', 'Template is empty.');
        }

        $template = Template::find($unit->template_id);

        // Validating that the selected template has the selected components.
        if($template->components->count() != count($unit->components))
        {
            throw new CustomInvalidInputException($prefix.'components', 'Components are missing.');
        }

        foreach ($unit->components as $key => $component) 
        {            
            if(empty($component["_value"]))
            {                     
                throw new CustomInvalidInputException($prefix.'components', 'Components are missing.');
            }
        }
    }

    private function dispatchJobForVideoAndAudioConversion($unit)
    {
        foreach ($unit->components as $key => $component)
        {            
            $componentFound = Component::find($key);

            if($componentFound->type == "audio")
            {
                ProcessAudioToOggFormatJob::dispatch($unit, $key);
            }

            if($componentFound->type == "video")
            {
                ProcessVideoToOgvFormatJob::dispatch($unit, $key);
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
                if($unit->layout_id != $request->layout_id)
                {
                    // if layout is changed, we will remove all the holdees.
                    foreach($unit->holdee as $held) $held->delete();
                    
                    $unit->layout_id = $request->layout_id;
    
                    if($unit->layout->hasParent()) {
    
                        // if this layout is a holder layout
                        $unit->is_holder = true;
    
                        foreach(str_split($unit->layout->contents) as $layoutId) {
                            Unit::create([
                                'user_id'    => auth()->user()->id,
                                'holder_id'  => $unit->id,
                                'layout_id'  => $layoutId,
                                'type'       => $unit->type,
                                'components' => [],
                                'experimental_components' => [],
                                'is_holder' => false,
                            ]);
                        }
                    } else {
                        $unit->is_holder = false;
                    }
                }
                
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
                    $unit->experimental_components   = $preparedComponents;
                }
                
                if( ! is_null($request->experimental_components))
                {
                    $inputComponents = $request->experimental_components;
                    
                    $components = $template->components()->whereIn('id', array_keys($inputComponents))->get();
                    
                    
                    // Validating that the selected template has the selected components.
                    if($components->count() != count($inputComponents))
                    {
                        throw new InvalidInputException('Bad components sent.');
                    }
                    
                    $this->validateComponents($inputComponents, $template->id, true);
                    

                    $preparedComponents = $this->preparedComponents($inputComponents, $components);
                    
                    if(count($preparedComponents > 0))
                    {
                        $unit->experimental_components = $preparedComponents;
                    }
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
                        $unit->experimental_components = $preparedComponents;
                    }
                }
            }
            
            // if name is sent
            if(! is_null($request->name))
            {
                $unit->name = $request->name;
            }  

            // if category_id is sent
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

            // if is_popup is sent
            if(! is_null($request->is_popup))
            {
                $unit->is_popup = $request->is_popup;
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
                $preparedComponents[$component->id] = [
                    '_value' => [ 
                        'title'            => [ '_value' => '',  'background_color' => '#ffffff', 'foreground_color' => '#000000', 'size' => 30 ], 
                        'question'         => [ '_value' => '', 'foreground_color' => '#000000', 'size' => 30 ], 
                        'box_color'        => '#0FE7D3', 
                        'yes_button_color' => '#59E519', 
                        'no_button_color'  => '#D30A0A'
                    ], 
                    '_yes' => 0, 
                    '_no' => 0 
                ];
            }
            else if($component->type == 'photogallery')
            {
                $preparedComponents[$component->id] = ['_value' => [['_value' => '']], 'background_color' => '#ffffff'];
            }
            else if($component->type == 'images')
            {
                $preparedComponents[$component->id] = [['_value' => '']];
            }
            else if($component->type == 'text')
            {
                $preparedComponents[$component->id] = ['_value' => '', 'background_color' => '#ffffff', 'foreground_color' => '#000000', 'size' => 12, 'halign' => 'left', 'valign' => 'top'];
            }
            else if($component->type == 'subtext')
            {
                $preparedComponents[$component->id] = ['_value' => '', 'foreground_color' => '#000000', 'size' => 15];
            }
            else if($component->type == 'timeline')
            {
                $preparedComponents[$component->id] = ['_value' => [
                    'title' => '',
                    'values' => [
                        [
                            'month' => '',
                            'year' => '',
                            'description' => '',
                            'image' => ''
                        ],
                        [
                            'month' => '',
                            'year' => '',
                            'description' => '',
                            'image' => ''
                        ],
                        [
                            'month' => '',
                            'year' => '',
                            'description' => '',
                            'image' => ''
                        ],
                        [
                            'month' => '',
                            'year' => '',
                            'description' => '',
                            'image' => ''
                        ],
                    ]
                ]];
            }
            else if($component->type == 'hours_of_operation')
            {
                $preparedComponents[$component->id] = ['_value' => [
                    'title' => '',
                    'background_color' => '#ffffff', 
                    'foreground_color' => '#000000', 
                    'size' => 30,
                    'open_box'=> [
                        '_value'           => '',
                        'background_color' => '#ffffff', 
                        'foreground_color' => '#000000', 
                        'size'             => 30
                    ],
                    'close_box'=> [
                        '_value'           => '',
                        'background_color' => '#ffffff',
                        'foreground_color' => '#000000', 
                        'size'             => 30
                    ],
                    'values' => [
                        [
                            'day' => [
                                '_value'           => '',
                                'foreground_color' => '#000000', 
                                'size'             => 30
                            ],
                            'open' => [
                                '_value'           => '',
                                'foreground_color' => '#000000', 
                                'size'             => 30
                            ],
                            'close' => [
                                '_value'           => '',
                                'foreground_color' => '#000000', 
                                'size'             => 30
                            ]
                        ]
                    ]
                ]];
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

        if($request->action == 'approve') 
        {
            // mailing the user for ad approval
            Mail::to($unitFound->user->first()->email)->send(new \App\Mail\AdApprovalMailToUser($unitFound->user->first(), $unitFound));             
        }
        else 
        {
            // mailing the user for ad rejection
            Mail::to($unitFound->user->first()->email)->send(new \App\Mail\AdRejectedMailToUser($unitFound->user->first(), $unitFound));             
        }

        return $unitFound->fresh();
    }

    private function validateComponents($components, $templateId, $skipRequiredCheck = false)
    {
        foreach ($components as $componentId => $value) 
        {
            $component = Component::find($componentId);

            if($component->type == 'images')
            {
                $validator = \Validator::make([$component->name => $value], [
                     $component->name . '.*._value' => [
                        $skipRequiredCheck ? 'nullable' : 'required',
                    ]
                ]);
                $validator->setCustomMessages([
                    $component->name . '.*._value.required' => 'All the images in ' . $component->name . ' are required.'
                ]);
            } 
            elseif($component->type == 'photogallery')
            {
                $validator = \Validator::make([$component->name => $value], [
                     $component->name . '._value.*._value' => [
                        $skipRequiredCheck ? 'nullable' : 'required',
                    ]
                ]);
                $validator->setCustomMessages([
                    $component->name . '*._value.required' => 'All the images in ' . $component->name . ' are required.'
                ]);
            }
            else if($component->type == "timeline")
            {

                $validator = \Validator::make([$component->name => $value], [
                     $component->name . '._value.title' => [
                        $skipRequiredCheck ? 'nullable' : 'required',
                    ],
                    $component->name . '._value.values.*.month' => [
                        $skipRequiredCheck ? 'nullable' : 'required',
                    ],
                    $component->name . '._value.values.*.year' => [
                        $skipRequiredCheck ? 'nullable' : 'required',
                    ],
                    $component->name . '._value.values.*.description' => [
                        $skipRequiredCheck ? 'nullable' : 'required',
                    ],
                    $component->name . '._value.values.*.image' => [
                        $skipRequiredCheck ? 'nullable' : 'required',
                        'url',
                        'regex:/^' . preg_quote(url()->to('/'), '/') . '/'
                    ]
                ]);

                $validator->setCustomMessages([
                    $component->name . '._value.title.required'                => 'Timeline title is required.',
                    $component->name . '._value.values.*.month.required'       => 'All the month in timeline are required.',
                    $component->name . '._value.values.*.year.required'        => 'All the year in timeline are required.',
                    $component->name . '._value.values.*.description.required' => 'All the description in timeline are required.',
                    $component->name . '._value.values.*.image.required'       => 'All the image in timeline are required.',
                    $component->name . '._value.values.*.image.url'            => 'All the images must be a valid url.',
                    $component->name . '._value.values.*.image.regex'          => 'All the image in timeline must be uploaded here.'
                ]);   
            }            
            else if($component->type == "survey")
            {
                $validator = \Validator::make([$component->name => $value], [
                     $component->name . '._value.title._value' => [
                        $skipRequiredCheck ? 'nullable' : 'required',
                    ],  
                    $component->name . '._value.question._value' => [
                        $skipRequiredCheck ? 'nullable' : 'required',
                    ],
                   
                ]);

                $validator->setCustomMessages([
                    $component->name . '._value.title._value.required' => 'Survey title is required.',
                    $component->name . '._value.question._value.required' => 'Survey question is required.',
                  
                ]);   
            }
            else if($component->type == "hours_of_operation")
            {
                $validator = \Validator::make([$component->name => $value], [
                     $component->name . '._value.title' => [
                        $skipRequiredCheck ? 'nullable' : 'required',
                    ],
                    $component->name . '._value.open_box._value' => [
                        $skipRequiredCheck ? 'nullable' : 'required',
                    ],
                    $component->name . '._value.close_box._value' => [
                        $skipRequiredCheck ? 'nullable' : 'required',
                    ],
                    $component->name . '._value.values.*.day' => [
                        $skipRequiredCheck ? 'nullable' : 'required',
                    ],
                    $component->name . '._value.values.*.open' => [
                        $skipRequiredCheck ? 'nullable' : 'required',
                    ],
                    $component->name . '._value.values.*.close' => [
                        $skipRequiredCheck ? 'nullable' : 'required',
                    ],                  
                ]);

                $validator->setCustomMessages([
                    $component->name . '._value.title.required'            => 'Hours Of Operation title is required.',
                    $component->name . '._value.open_box._value.required'  => 'Open Box title is required.',
                    $component->name . '._value.close_box._value.required' => 'Close Box title is required.',
                    $component->name . '._value.values.*.day.required'     => 'All the day in timeline are required.',
                    $component->name . '._value.values.*.open.required'    => 'All the open in timeline are required.',
                    $component->name . '._value.values.*.close.required'   => 'All the close in timeline are required.',
                ]);   
            }
            else if($component->type == "color")
            {
                $validator = \Validator::make([$component->name => $value['_value']], [
                     $component->name => [
                         $skipRequiredCheck ? 'nullable' : 'required',
                        'regex:/^(\#[\da-f]{3}|\#[\da-f]{6}|rgba\(((\d{1,2}|1\d\d|2([0-4]\d|5[0-5]))\s*,\s*){2}((\d{1,2}|1\d\d|2([0-4]\d|5[0-5]))\s*)(,\s*(0\.\d+|1))\)|hsla\(\s*((\d{1,2}|[1-2]\d{2}|3([0-5]\d|60)))\s*,\s*((\d{1,2}|100)\s*%)\s*,\s*((\d{1,2}|100)\s*%)(,\s*(0\.\d+|1))\)|rgb\(((\d{1,2}|1\d\d|2([0-4]\d|5[0-5]))\s*,\s*){2}((\d{1,2}|1\d\d|2([0-4]\d|5[0-5]))\s*)|hsl\(\s*((\d{1,2}|[1-2]\d{2}|3([0-5]\d|60)))\s*,\s*((\d{1,2}|100)\s*%)\s*,\s*((\d{1,2}|100)\s*%)\))$/i',
                    ]
                ]);
            }
            else
            {
                $validator = \Validator::make([$component->name => $value['_value']], [
                    $component->name => [
                        $skipRequiredCheck ? 'nullable' : 'required',
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
                    $component->name . '.*._value.regex' => 'All the values in '. $component->name .' must be uploaded here.'
                ]);
            } 
            else if($component->type == 'photogallery')
            {
                $validator->addRules([
                    $component->name . '._value.*._value' => [
                        'url',
                        'regex:/^' . preg_quote(url()->to('/'), '/') . '/'
                    ]
                ]);
                $validator->setCustomMessages([
                    $component->name . '._value.*._value.url' => 'All the values in '. $component->name .' must be valid.',
                    $component->name . '._value.*._value.regex' => 'All the values in '. $component->name .' must be uploaded here.'
                ]);
            } else if(in_array($component->type, ['image', 'audio', 'video'])) {
                $validator->addRules([
                    $component->name => [
                        'url',
                        'regex:/^' . preg_quote(url()->to('/'), '/') . '/'
                    ]
                ]);
                $validator->setCustomMessages([
                    $component->name . '.regex' => 'All the values in '. $component->name .' must be uploaded here.'
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
                } 
                else if($component->type == 'photogallery')
                {
                    $validator->addRules([
                        $component->name . '._value.*._value' => [
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
