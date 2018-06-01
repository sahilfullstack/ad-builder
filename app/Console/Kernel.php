<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\ChangePermissionOfUserCommand::class,
        Commands\CreateLayoutCommand::class,
        Commands\ApproveUserCommand::class,
        Commands\SeedUsersSubscriptionsCommand::class,
        Commands\RefactorComponentsStructureInUnits::class,
        Commands\SeedOldUsernameCommand::class,
        Commands\MakeDummyUnitCommand::class,
        Commands\MakeLocalCopiesOfRemoteAssetsInUnits::class,
        Commands\MakeDummyUnitForAllTemplatesCommand::class,
        Commands\ConvertMp4VideoToOgvCommand::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

        // $schedule->command('inspire')
        //          ->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
