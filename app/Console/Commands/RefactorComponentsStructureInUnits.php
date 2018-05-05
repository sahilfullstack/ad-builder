<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Unit;

class RefactorComponentsStructureInUnits extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'refactor:components-in-units';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refactor components structure in units.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $units = Unit::withTrashed()->get();

        foreach($units as $unit)
        {
            $updatedComponents = [];

            foreach($unit->template->components as $component)
            {
                if(isset($unit->components[$component->slug]))
                {
                    $updatedComponents[$component->id] = [
                        '_value' => $unit->components[$component->slug]
                    ];
                }
                else if (isset($unit->components[$component->id])) {
                    $updatedComponents[$component->id] = [
                        '_value' => $unit->components[$component->id]['_value']
                    ];
                }
                else
                {
                    $updatedComponents[$component->id] = [
                        '_value' => ''
                    ];
                }
            }

            $unit->components = $updatedComponents;

            $unit->save();
        }
    }
}
