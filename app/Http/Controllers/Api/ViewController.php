<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\View;
use Carbon\Carbon;
use App\Http\Requests\StoreViewRequest;

class ViewController extends Controller
{
    public function store(StoreViewRequest $request)
    {
        $view = new View([
            'unit_id' => $request->input('unit_id'),
            'viewed_at' => Carbon::createFromTimestamp($request->input('viewed_at')),
            'duration' => $request->input('duration'),
            'category_id' => $request->input('category_id'),
            'landing_from' => $request->input('landing_from')
        ]);

        $view->save();

        return response('', 204);
    }
}
