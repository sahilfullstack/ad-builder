<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use App\Models\Unit;
use App\Traits\StatisticsTrait;

class StatisticsController extends Controller
{
    use StatisticsTrait;

    public function show(Request $request, $type)
    {
        $today = Carbon::now()->timezone('CST')->startOfDay();

        $needToRedirect = false;

        $from = $request->input('from');
        $to = $request->input('to');

        // if no 'to' is passed, consider today to be the 'to'
        if(is_null($to))
        {
            $to = $today;
            $needToRedirect = true;
        }
        else
        {
            $to = Carbon::parse($to);
        }
        
        // if no 'from' is passed, consider one month period from 'to'
        if(is_null($from))
        {
            $from = $to->copy()->subMonth();
            $needToRedirect = true;
        }
        else
        {
            $from = Carbon::parse($from);
        }
        
        if($needToRedirect) return redirect(
            route(
                'stats.show',
                array_merge([
                    'type' => $type,
                    'from' => $from->toDateString(),
                    'to' => $to->toDateString()
                ], $request->query())
            )
        );

        list($type, $range, $from, $to, $path, $filters, $report, $ylabel, $name) = $this->{'get' . Str::studly($type)}($request, $from->toDateString(), $to->toDateString());

        return view('stats.show', compact('type', 'range', 'from', 'to', 'path', 'filters', 'report', 'ylabel', 'name'));
    }
}
