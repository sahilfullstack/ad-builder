<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PinnedReport;
use App\Traits\StatisticsTrait;
use Carbon\Carbon;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
	use StatisticsTrait;

    public function dashboard(Request $request)
    {
    	$today = Carbon::today();
        $needToRedirect = false;

        $from = $request->input('from');
        $to = $request->input('to');

        // if no 'to' is passed, consider today to be the 'to'
        if(is_null($to))
        {
            $to = $today;
        }
        else
        {
            $to = Carbon::parse($to);
        }
        
        // if no 'from' is passed, consider one month period from 'to'
        if(is_null($from))
        {
            $from = $to->copy()->subMonth();
        }
        else
        {
            $from = Carbon::parse($from);
        }

        $path = $request->path();
        $filters = [];

    	$reports = $this->getPinnedReports($request, $from, $to);

        return view('dashboard.home', compact('reports', 'path', 'from', 'to', 'filters'));
    }    

    public function accessToken()
    {
        return view('dashboard.access_token');
    }

    private function getPinnedReports(Request $request, $from, $to)
    {	
    	$preparedReports = [];
    	$pinnedReports = PinnedReport::where('user_id', auth()->user()->id)
    			->whereNull('deleted_at')
    			->where('deleted_at_millis', 0)
	    		->get();

	    foreach ($pinnedReports as $key => $pinnedReport) 
	    {
	    	foreach ($pinnedReport->filter as $filter) 
	    	{
				$request->merge(array($filter['slug'] => $filter['selected']));
	    	}

	        list($type, $range, $fromDate, $toDate, $path, $filters, $report) = $this->{'get' . Str::studly($pinnedReport->report)}($request, $from->toDateString(), $to->toDateString());

	        $preparedReports[] = [$type, $range, $fromDate, $toDate, $path, $filters, $report, $pinnedReport];
	    }

	    return $preparedReports;
    }
}
