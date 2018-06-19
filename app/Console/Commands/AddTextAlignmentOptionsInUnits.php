<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Unit;

class AddTextAlignmentOptionsInUnits extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'refactor:add-alignment-options-in-units';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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

        foreach ($units as $unit) {
            $updatedComponents = [];

            if (is_null($unit->template)) continue;

            foreach ($unit->template->components as $component) {
                if($component->type != 'text') {
                    if(isset($unit->components[$component->id]))
                    {
                        $updatedComponents[$component->id] = $unit->components[$component->id];
                    }
                } else {
                    $updatedComponents[$component->id] = array_merge($unit->components[$component->id], ['valign' => 'top', 'halign' => 'left']);
                }
            }

            $unit->components = $updatedComponents;

            $unit->save();
        }
    }
}
