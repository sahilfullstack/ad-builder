<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\Unit;

trait StatisticsTrait
{
    protected function getViewsCount(Request $request, $from, $to)
    {
        $source = $request->input('source');
        $unitId = $request->input('unit_id');

        // select count(*), date(viewed_at) as viewed_on from views join units on views.unit_id = units.id where units.user_id = 1 and landing_from = 'category' group by viewed_on;
        $query = DB::table('views')
            ->join('units', 'views.unit_id', '=', 'units.id')
            ->select(DB::raw('count(*) as view_count, date(viewed_at) as viewed_on'))
            ->where('units.user_id', auth()->user()->id)
            ->whereNotNull('views.landing_from')
            ->where(DB::raw('date(views.viewed_at)'), '>=', $from)
            ->where(DB::raw('date(views.viewed_at)'), '<=', $to)
            ->groupBy('viewed_on');
            
        if(! is_null($unitId)) $query->where('units.id', $unitId);
        if(! is_null($source)) $query->where('views.landing_from', $source);
        
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
        $filters = [
            $this->getSourcesFilter($source),
            $this->getAdsFilter($unitId)
        ];

        $report = 'views-count';

        return [$type, $range, $from, $to, $path, $filters, $report, "views", "Total Views(Landing Pages)"];
    }

    protected function getViewsDuration(Request $request, $from, $to)
    {
        $source = $request->input('source');
        $unitId = $request->input('unit_id');

        // select sum(duration) as time_spent, date(viewed_at) as viewed_on from views join units on views.unit_id = units.id where units.user_id = 1 and landing_from = 'category' group by viewed_on;
        $query = DB::table('views')
            ->join('units', 'views.unit_id', '=', 'units.id')
            ->select(DB::raw('sum(duration) as time_spent, date(viewed_at) as viewed_on'))
            ->where('units.user_id', auth()->user()->id)
            ->whereNotNull('views.landing_from')
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
        $filters = [
            $this->getSourcesFilter($source),
            $this->getAdsFilter($unitId)
        ];

        $report = 'views-duration';

        return [$type, $range, $from, $to, $path, $filters, $report, "seconds", "Views Duration(Landing Pages)"];
    }

    protected function getAdViewsCount(Request $request, $from, $to)
    {
        $unitId = $request->input('unit_id');

        // select count(*), date(viewed_at) as viewed_on from views join units on views.unit_id = units.id where units.user_id = 1 and landing_from = 'category' group by viewed_on;
        $query = DB::table('views')
            ->join('units', 'views.unit_id', '=', 'units.id')
            ->select(DB::raw('count(*) as view_count, date(viewed_at) as viewed_on'))
            ->where('units.user_id', auth()->user()->id)
            ->whereNull('views.landing_from')
            ->where(DB::raw('date(views.viewed_at)'), '>=', $from)
            ->where(DB::raw('date(views.viewed_at)'), '<=', $to)
            ->groupBy('viewed_on');

        if (!is_null($unitId)) $query->where('units.id', $unitId);

        $result = $query->get();
        
        // getting empty date range
        $range = $this->generateDateRange($from, $to);
        // filling the data for the dates that we have data for
        foreach ($result as $entry) {
            $range[$entry->viewed_on] = $entry->view_count;
        }

        // pass the data to the view
        $type = 'daterange';
        $path = '/' . $request->path();
        $filters = [
            $this->getAdsFilter($unitId)
        ];

        $report = 'ad-views-count';

        return [$type, $range, $from, $to, $path, $filters, $report, "views", "Total Views(Ads)"];
    }

    protected function getAdViewsDuration(Request $request, $from, $to)
    {
        $unitId = $request->input('unit_id');

        // select sum(duration) as time_spent, date(viewed_at) as viewed_on from views join units on views.unit_id = units.id where units.user_id = 1 and landing_from = 'category' group by viewed_on;
        $query = DB::table('views')
            ->join('units', 'views.unit_id', '=', 'units.id')
            ->select(DB::raw('sum(duration) as time_spent, date(viewed_at) as viewed_on'))
            ->where('units.user_id', auth()->user()->id)
            ->whereNull('views.landing_from')
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
        $filters = [
            $this->getAdsFilter($unitId)
        ];

        $report = 'ad-views-duration';

        return [$type, $range, $from, $to, $path, $filters, $report, "seconds", "Views Duration(Ads)"];
    }

    protected function getLayoutPerformance(Request $request, $from, $to)
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
        $filters = [
            // none
        ];

        $report = 'layout-performance';

        return [$type, $range, $from, $to, $path, $filters, $report, "performance", "Layout Performance"];
    }

    protected function getSubscriptionSum(Request $request, $from, $to)
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
        $filters = [
            // none
        ];

        $report = 'subscription-sum';

        return [$type, $range, $from, $to, $path, $filters, $report, "subscriptions", "Total Subscriptions"];
    }

    protected function getSubscriptionsByLayout(Request $request, $from, $to)
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
        $filters = [
            // none
        ];

        $report = 'subscriptions-by-layout';

        return [$type, $range, $from, $to, $path, $filters, $report, "subscriptions", "Subscriptions by layout"];
    }

    protected function getViewsDurationOthers(Request $request, $from, $to)
    {
        $source = $request->input('source');
        $unitId = $request->input('unit_id');

        // select sum(duration) as time_spent, date(viewed_at) as viewed_on from views join units on views.unit_id = units.id where units.user_id <> 1 and landing_from = 'category' group by viewed_on;
        $query = DB::table('views')
            ->join('units', 'views.unit_id', '=', 'units.id')
            ->select(DB::raw('sum(duration) as time_spent, date(viewed_at) as viewed_on'))
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
        $filters = [
            $this->getSourcesFilter($source),
            $this->getAdsFilter($unitId)
        ];

        $report = 'views-duration-others';

        return [$type, $range, $from, $to, $path, $filters, $report, "seconds", "Competitor's Views Duration"];
    }

    protected function getViewsAverageDuration(Request $request, $from, $to)
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
        $filters = [
            $this->getSourcesFilter($source),
            $this->getAdsFilter($unitId)
        ];

        $report = 'views-average-duration';

        return [$type, $range, $from, $to, $path, $filters, $report, "seconds", "Average Views Duration"];
    }

    protected function getViewsAverageDurationOthers(Request $request, $from, $to)
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
        $filters = [
            $this->getSourcesFilter($source),
            $this->getAdsFilter($unitId)
        ];

        $report = 'views-average-duration-others';

        return [$type, $range, $from, $to, $path, $filters, $report, "seconds", "Competitor's Average Views Duration"];
    }

    private function getSourcesFilter($selected = null)
    {
        return [
            'name' => 'Source',
            'slug' => 'source',
            'options' => [
                'category' => 'Category',
                'navigation' => 'Navigation',
                'alphabet' => 'Alphabet',
                'slideshow' => 'Slideshow'
            ],
            'selected' => $selected,
        ];
    }

    private function getAdsFilter($selected = null)
    {
        return [
            'name' => 'Ad',
            'slug' => 'unit_id',
            'options' => Unit::ad()->published()->forCurrentUser()->latest()->get()->pluck('name', 'id')->mapWithKeys(function($name, $id) {
                return ['-'.$id => $name];
            }),
            'selected' => $selected,
        ];
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