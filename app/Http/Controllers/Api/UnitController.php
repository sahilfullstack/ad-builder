<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Template;
use App\Models\Component;
use App\Models\Unit;
use App\Http\Requests\StoreUnitRequest;
use App\Exceptions\InvalidInputException;

class UnitController extends Controller
{
    public function store(StoreUnitRequest $request)
    {
        $inputComponents = $request->components;

        
        $template = Template::find($request->template_id);
        $components = $template->components()->whereIn('id', array_keys($inputComponents))->get();

        if($components->count() != count($inputComponents))
        {
            throw InvalidInputException('Bad components sent.');
        }

        $unit = new Unit([
            'name' => $request->name,
            'template_id' => $request->template_id,
            'components' => $components->map(function($component) use ($inputComponents) {
                return [$component->slug => $inputComponents[$component->id]];
            })
        ]);

        $unit->save();

        return $unit->fresh();
    }
}
