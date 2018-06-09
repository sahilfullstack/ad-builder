<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\Models\{Template, Unit, Component};
use Carbon\Carbon, Storage;

class MailAdminForProcessedUnits extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail-admin-for-processed-units';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to mail admin for processed units.';

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
        $units = Unit::where([
            'approved_at' => null,
            'processed_at' => null,
            ])
            ->whereNotNull('published_at')
            ->get();

        foreach ($units as $unit) 
        {
            $processed = true;

            foreach ($unit->components as $key => $component)
            {
                $componentFound = Component::find($key);

                if($componentFound->type == "audio" or 
                    $componentFound->type == "video")
                {
                    if(! isset($component['converted_value']))
                    {
                        $processed = false;
                    }
                }
            }        


            if($processed)
            {
                // $unit->processed_at = Carbon::now();
                // $unit->save();
                \Log::info("mail the admin about the completion of process about unit with id : ". $unit->id);
            }
        }

        // mailing the admin for publishing new unit
        // Mail::to(env('ADMIN_EMAIL'))->send(new \App\Mail\NewUnitCreationMailToAdmin($unit->user->first()));             

    }
}
