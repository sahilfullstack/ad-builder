<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use Carbon\Carbon;

class ApproveUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'approve-user {user}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to approve user.';

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
        $user = $this->argument('user');

        $userFound = User::find($user);

        if(is_null($user)) 
        {
            $this->info("invalid user");
            exit();
        }

        $userFound->approved_at = Carbon::now();
        $userFound->active = 1;
        $userFound->save();

        $this->info("user has been approved.");
    }
}
