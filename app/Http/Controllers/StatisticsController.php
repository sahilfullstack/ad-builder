<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

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

        return $this->{'show' . Str::studly($type)}($request, $from->toDateString(), $to->toDateString());
    }

    protected function showViewsCount(Request $request, $from, $to)
    {
        $source = $request->input('source');
        $unitId = $request->input('unit_id');
        
        if(is_null($source)) return response('Please select a source.', 422);

        // select count(*), date(viewed_at) as viewed_on from views join units on views.unit_id = units.id where units.user_id = 1 and landing_from = 'category' group by viewed_on;
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
        $type = 'daterange';
        $path = '/' . $request->path();
        return view('stats.show', compact('type', 'range', 'from', 'to', 'path'));
    }

    protected function showViewsDuration(Request $request, $from, $to)
    {
        $source = $request->input('source');
        $unitId = $request->input('unit_id');

        if (is_null($source)) return response('Please select a source.', 422);

        // select sum(duration) as time_spent, date(viewed_at) as viewed_on from views join units on views.unit_id = units.id where units.user_id = 1 and landing_from = 'category' group by viewed_on;
        $query = DB::table('views')
            ->join('units', 'views.unit_id', '=', 'units.id')
            ->select(DB::raw('sum(duration) as time_spent, date(viewed_at) as viewed_on'))
            ->where('units.user_id', auth()->user()->id)
            ->where('views.landing_from', $source)
            ->where(DB::raw('date(views.viewed_at)'), '>=', $from)
            ->where(DB::raw('date(views.viewed_at)'), '<=', $to)
            ->groupBy('viewed_on');

        if (!is_null($unitId)) $query->where('units.id', $unitId);

        $result = $query->get();
        
        // getting empty date range
        $range = $this->generateDateRange($from, $to);
        // filling the data for the dates that we have data for
        foreach ($result as $entry) {
            $range[$entry->viewed_on] = $entry->time_spent;
        }

        // pass the data to the view
        $type = 'daterange';
        $path = '/' . $request->path();
        return view('stats.show', compact('type', 'range', 'from', 'to', 'path'));
    }

    protected function showLayoutPerformance(Request $request, $from, $to)
    {
        // select sum(views.duration) as performance, units.layout_id from views join units on views.unit_id = units.id group by units.layout_id order by performance desc;
        $query = DB::table('views')
            ->join('units', 'views.unit_id', '=', 'units.id')
            ->join('layouts', 'units.layout_id', '=', 'layouts.id')
            ->select(DB::raw('sum(duration) as performance, layouts.name'))
            ->where(DB::raw('date(views.created_at)'), '>=', $from)
            ->where(DB::raw('date(views.created_at)'), '<=', $to)
            ->groupBy('layouts.id');

        $result = $query->get();
        
        // getting empty date range
        $range = [];
        // filling the data for the dates that we have data for
        foreach ($result as $entry) {
            $range[$entry->name] = $entry->performance;
        }
        
        // pass the data to the view
        $type = 'pie';
        $path = '/' . $request->path();
        return view('stats.show', compact('type', 'range', 'from', 'to', 'path'));
    }

    protected function showSubscriptionSum(Request $request, $from, $to)
    {
        // select sum(allowed_quantity), date(subscriptions.created_at) as created_on from subscriptions join layouts on subscriptions.layout_id = layouts.id group by created_on;
        $query = DB::table('subscriptions')
            ->select(DB::raw('sum(allowed_quantity) as subscription_count, date(created_at) as created_on'))
            ->where(DB::raw('date(created_at)'), '>=', $from)
            ->where(DB::raw('date(created_at)'), '<=', $to)
            ->groupBy('created_on');

        $result = $query->get();
        
        // getting empty date range
        $range = $this->generateDateRange($from, $to);
        // filling the data for the dates that we have data for
        foreach ($result as $entry) {
            $range[$entry->created_on] = $entry->subscription_count;
        }
        
        // pass the data to the view
        $type = 'daterange';
        $path = '/' . $request->path();
        return view('stats.show', compact('type', 'range', 'from', 'to', 'path'));
    }

    protected function showSubscriptionsByLayout(Request $request, $from, $to)
    {
        // select layouts.name, sum(allowed_quantity) from subscriptions join layouts on subscriptions.layout_id = layouts.id group by layout_id;
        $query = DB::table('subscriptions')
            ->join('layouts', 'subscriptions.layout_id', '=', 'layouts.id')
            ->select(DB::raw('layouts.name, sum(allowed_quantity) as subscription_count'))
            ->where(DB::raw('date(subscriptions.created_at)'), '>=', $from)
            ->where(DB::raw('date(subscriptions.created_at)'), '<=', $to)
            ->groupBy('subscriptions.layout_id');

        $result = $query->get();
        
        // getting empty date range
        $range = [];
        // filling the data for the dates that we have data for
        foreach ($result as $entry) {
            $range[$entry->name] = $entry->subscription_count;
        }

        // pass the data to the view
        $type = 'pie';
        $path = '/' . $request->path();
        return view('stats.show', compact('type', 'range', 'from', 'to', 'path'));
    }

    protected function showViewsDurationOthers(Request $request, $from, $to)
    {
        $source = $request->input('source');
        $unitId = $request->input('unit_id');

        if (is_null($source)) return response('Please select a source.', 422);

        // select sum(duration) as time_spent, date(viewed_at) as viewed_on from views join units on views.unit_id = units.id where units.user_id <> 1 and landing_from = 'category' group by viewed_on;
        $query = DB::table('views')
            ->join('units', 'views.unit_id', '=', 'units.id')
            ->select(DB::raw('sum(duration) as time_spent, date(viewed_at) as viewed_on'))
            ->where('units.user_id', '<>', auth()->user()->id)
            ->where('views.landing_from', $source)
            ->where(DB::raw('date(views.viewed_at)'), '>=', $from)
            ->where(DB::raw('date(views.viewed_at)'), '<=', $to)
            ->groupBy('viewed_on');

        if (!is_null($unitId)) $query->where('units.id', $unitId);

        $result = $query->get();
        
        // getting empty date range
        $range = $this->generateDateRange($from, $to);
        // filling the data for the dates that we have data for
        foreach ($result as $entry) {
            $range[$entry->viewed_on] = $entry->time_spent;
        }

        // pass the data to the view
        $type = 'daterange';
        $path = '/' . $request->path();
        return view('stats.show', compact('type', 'range', 'from', 'to', 'path'));
    }

    protected function showViewsAverageDuration(Request $request, $from, $to)
    {
        $source = $request->input('source');
        $unitId = $request->input('unit_id');

        // select avg(duration) as time_spent, date(viewed_at) as viewed_on from views join units on views.unit_id = units.id where units.user_id = 1 group by viewed_on;
        $query = DB::table('views')
            ->join('units', 'views.unit_id', '=', 'units.id')
            ->select(DB::raw('avg(duration) as time_spent, date(viewed_at) as viewed_on'))
            ->where('units.user_id', auth()->user()->id)
            ->where(DB::raw('date(views.viewed_at)'), '>=', $from)
            ->where(DB::raw('date(views.viewed_at)'), '<=', $to)
            ->groupBy('viewed_on');
            
        if(!is_null($unitId)) $query->where('units.id', $unitId);
        if(!is_null($source)) $query->where('views.landing_from', $source);
            
        $result = $query->get();
        
        // getting empty date range
        $range = $this->generateDateRange($from, $to);
        // filling the data for the dates that we have data for
        foreach ($result as $entry) {
            $range[$entry->viewed_on] = $entry->time_spent;
        }

        // pass the data to the view
        $type = 'daterange';
        $path = '/' . $request->path();
        return view('stats.show', compact('type', 'range', 'from', 'to', 'path'));
    }

    protected function showViewsAverageDurationOthers(Request $request, $from, $to)
    {
        $source = $request->input('source');
        $unitId = $request->input('unit_id');

        // select avg(duration) as time_spent, date(viewed_at) as viewed_on from views join units on views.unit_id = units.id where units.user_id <> 1 group by viewed_on;
        $query = DB::table('views')
            ->join('units', 'views.unit_id', '=', 'units.id')
            ->select(DB::raw('avg(duration) as time_spent, date(viewed_at) as viewed_on'))
            ->where('units.user_id', '<>', auth()->user()->id)
            ->where(DB::raw('date(views.viewed_at)'), '>=', $from)
            ->where(DB::raw('date(views.viewed_at)'), '<=', $to)
            ->groupBy('viewed_on');

        if (!is_null($unitId)) $query->where('units.id', $unitId);
        if (!is_null($source)) $query->where('views.landing_from', $source);

        $result = $query->get();
        
        // getting empty date range
        $range = $this->generateDateRange($from, $to);
        // filling the data for the dates that we have data for
        foreach ($result as $entry) {
            $range[$entry->viewed_on] = $entry->time_spent;
        }

        // pass the data to the view
        $type = 'daterange';
        $path = '/' . $request->path();
        return view('stats.show', compact('type', 'range', 'from', 'to', 'path'));
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
