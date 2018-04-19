<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Template;
use App\Models\Component;
use App\Models\Unit;
use App\Http\Requests\StoreTemplateRequest;
use App\Exceptions\InvalidInputException;

class TemplateController extends Controller
{
    public function store(StoreTemplateRequest $request)
    {
        $inputComponents = $request->components;

        $template = new Template([
            'type'    => $request->type,
            'layout_id'    => $request->layout_id,
            'name'    => $request->name,
            'slug'    => str_slug($request->name),
            'user_id' => auth()->user()->id
        ]);

        $template->save();


        foreach ($inputComponents as $key => $inputComponent) 
        {
            $rules = isset($inputComponent['rules']) ? $inputComponent['rules']: [];
            $rules = $this->prepareRules( $inputComponent['type'],  $rules);

            $component = new Component([
                'template_id' => $template->id,
                'order'       => $key,
                'name'        => $inputComponent['name'],
                'slug'        => str_slug($inputComponent['name']),
                'type'        => $inputComponent['type'],
                'rules'       => $rules
            ]);

            $component->save();
        }

        return $template->fresh();
    }

    private function prepareRules($type, $rules)
    {
        $validRules = [
            'text' => [
                 'min_length',
                'max_length'
            ],
            'video' => [
                'height',
                'width',
                'max_duration',
                'min_duration'
            ],
            'image' => [
                'height',
                'width',
            ]
        ];

        $preparedRules = [];
        foreach ($rules as $key => $value) {

            if(in_array($key, $validRules[$type]))
            {
                if(is_numeric($value))
                {

                    $preparedRules[$key] = $value;
                }
                
            }

        }

        return $preparedRules;
    }
}
