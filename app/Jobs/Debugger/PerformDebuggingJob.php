<?php

namespace App\Jobs\Debugger;

use Mail;

class PerformDebuggingJob
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct() {}

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle($bug)
    {
        $command = getBugInstance();

        exec( $command, $output, $worked );

        $reminder = "Reminder";

        switch( $worked ) {
            case 0:
                $reminder = 'Bug Solved';
                break;
            case 1:
                $reminder = 'Warning occured';
                break;
            case 2:
                $reminder = 'Error Occured'
                ;
                break;
        }

        mail_admin_about_bug($reminder, $bug['type']);

        fix_it();
    }
}
