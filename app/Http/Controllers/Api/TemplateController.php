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
dd($request->all());
        $inputComponents = $request->components;

        $template = Template::find($request->template_id);
        $components = $template->components()->whereIn('id', array_keys($inputComponents))->get();

        // Validating that the selected template has the selected components.
        if($components->count() != count($inputComponents))
        {
            throw InvalidInputException('Bad components sent.');
        }

        // Creating the unit.
        $preparedComponents = [];
        foreach($components as $component)
        {
            $preparedComponents[$component->slug] = $inputComponents[$component->id];
        }

        $template = new Template([
            'type' => $request->type,
            'name' => $request->name
        ]);

        $template->save();

        return $template->fresh();
    }
}
