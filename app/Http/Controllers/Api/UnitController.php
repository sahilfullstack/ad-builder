<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Template;
use App\Models\Component;
use App\Models\Unit;
use App\Http\Requests\StoreTemplateRequest;
use App\Exceptions\InvalidInputException;

class UnitController extends Controller
{
    public function store(StoreTemplateRequest $request)
    {
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
        $unit = new Unit([
            'name' => $request->name,
            'template_id' => $request->template_id,
            'components' => $preparedComponents
        ]);

        $unit->save();

        return $unit->fresh();
    }
}
