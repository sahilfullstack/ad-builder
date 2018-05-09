<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use Carbon\Carbon;
use App\Models\{Layout, Subscription};

class SeedOldUsernameCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seed:old-username';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to seed old usernames of the users.';

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
        $users  = User::get();

        foreach ($users as $key => $user) {
            $this->info("saving for user with id - ".$user->id);
            $user->username = $user->email;
            $user->save();
        }
    }
}
