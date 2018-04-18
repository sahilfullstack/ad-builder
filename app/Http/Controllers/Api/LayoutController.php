<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Layout, Component, Unit};
use App\Http\Requests\StoreLayoutRequest;
use App\Exceptions\InvalidInputException;

class LayoutController extends Controller
{
    public function store(StoreLayoutRequest $request)
    {
        $inputComponents = $request->components;

        $layout = new Layout([
            'name'    => $request->name,
            'slug'    => str_slug($request->name),
            'user_id' => auth()->user()->id
        ]);

        $layout->save();

        return $layout->fresh();
    }
}