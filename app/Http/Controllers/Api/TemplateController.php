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
            'name'    => $request->name,
            'slug'    => str_slug($request->name),
            'user_id' => auth()->user()->id
        ]);

        $template->save();


        foreach ($inputComponents as $key => $inputComponent) 
        {
            $component = new Component([
                'template_id' => $template->id,
                'order'       => $key,
                'name'        => $inputComponent['name'],
                'slug'        => str_slug($inputComponent['name']),
                'type'        => $inputComponent['type']
            ]);

            $component->save();
        }

        return $template->fresh();
    }
}
