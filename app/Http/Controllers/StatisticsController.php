<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class StatisticsController extends Controller
{
    public function show(Request $request, $type)
    {
        $today = Carbon::today();
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

        return $this->{"show$type"}($request, $from->toDateString(), $to->toDateString());
    }

    protected function show12(Request $request, $from, $to)
    {
        $source = $request->input('source');
        $unitId = $request->input('unit_id');
        
        if(is_null($source)) return response('Please select a source.', 422);

        $query = DB::table('views')
            ->join('units', 'views.unit_id', '=', 'units.id')
            ->select(DB::raw('count(*) as view_count, date(viewed_at) as viewed_on'))
            ->where('units.user_id', auth()->user()->id)
            ->where('views.landing_from', $source)
            ->where(DB::raw('date(views.viewed_at)'), '>=', $from)
            ->where(DB::raw('date(views.viewed_at)'), '<=', $to)
            ->groupBy('viewed_on');

        if(! is_null($unitId)) $query->where('units.id', $unitId);
        
        $result = $query->get();
        
        // getting empty date range
        $range = $this->generateDateRange($from, $to);
        // filling the data for the dates that we have data for
        foreach($result as $entry)
        {
            $range[$entry->viewed_on] = $entry->view_count;
        }

        // pass the data to the view
        return view('stats.show', compact('range'));
    }

    private function generateDateRange($from, $to, $default = 0)
    {
        $from = Carbon::parse($from);
        $to = Carbon::parse($to);

        $dates = [];

        for ($date = $from; $date->lte($to); $date->addDay()) {
            $dates[$date->format('Y-m-d')] = $default;
        }

        return $dates;
    }
}
