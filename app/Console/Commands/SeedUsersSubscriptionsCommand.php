<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use Carbon\Carbon;
use App\Models\{Layout, Subscription};

class SeedUsersSubscriptionsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seed:users-subscriptions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to seed users subscriptions.';

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
        $layouts = Layout::notDeleted()->get();

        foreach ($users as $key => $user) {
            $this->info("seedig user". $user->id);
            foreach ($layouts as $key => $layout) {

                // $subscription = Subscription::where([
                //     'user_id'        => $user->id,
                //     'layout_id' => $layout->id
                //     ])->first();

                // if(is_null($subscription))
                // {
                    $subscription = new Subscription([
                        'user_id'        => $user->id,
                        'layout_id' => $layout->id,
                        'allowed_quantity' => 3,
                        'expiring_at'    => Carbon::now()->addDays(10),
                        'created_at'     => Carbon::now(),
                        'updated_at'     => Carbon::now()
                    ]);

                    $subscription->save();
                // }

                dd("stop");
            }
        }
    }
}
