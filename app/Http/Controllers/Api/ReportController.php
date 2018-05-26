<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PinnedReport;
use App\Exceptions\{InvalidInputException, CustomInvalidInputException};

use Carbon\Carbon;

class ReportController extends Controller
{
    public function pin(Request $request)
    {
    	$filters = $request->get('filters');

        if( ! $this->canPinReport())
        {
            throw new CustomInvalidInputException('general', 'Cannot pin more than 3 reports.');
        }

    	$preparedFilters = $this->prepareFilters($filters);

    	  // Blank unit is created
        $unit = new PinnedReport([
			'user_id' => auth()->user()->id,
			'report'  => $request->get('report'),
			'filter'  => $preparedFilters
        ]);

        $unit->save();

        return $unit->fresh();
    }

    private function canPinReport()
    {
        return (PinnedReport::where([
                'user_id'           => auth()->user()->id,
                'deleted_at'        => null,
                'deleted_at_millis' => 0
            ])->count() < 3);
    }

    private function prepareFilters($filters)
    {
    	$preparedFilters = [];

    	foreach ($filters as $filter) 
    	{
    		$preparedFilters[$filter['slug']] = $filter['selected'];
    	}

    	return $preparedFilters;
    }

    public function unpin(PinnedReport $pinnedReport)
    {
        $pinnedReport->delete();

        return  $pinnedReport->fresh();
    }
}