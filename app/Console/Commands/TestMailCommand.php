<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User, Mail;
use Carbon\Carbon;

class TestMailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test-mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to test mail.';

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
        $userFound = User::find(1);
        Mail::to($userFound->email)->send(new \App\Mail\AccountApprovalMailToUser($userFound));             

        $this->info("mail triggered.");
    }
}