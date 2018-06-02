<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Unit;
use App\Models\Subscription;
use Illuminate\Support\Carbon;
use App\Models\Component;

class DeductDaysInSubscriptions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscription:deduct-days';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deducts the days by one everyday from subscriptions for as many ads that are published and approved.';

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
        $this->info('Deducting days on... ' . Carbon::now()->toDateTimeString());
        $units = Unit::ad()->noHoldees()->published()->approved()
            ->orderBy('is_holder', 'desc')
            ->orderBy('layout_id')->get();
        $this->info('Processing... ' . $units->count() . ' units.');

        foreach($units as $index => $unit)
        {
            $this->info('Unit #' . ($index + 1) . '...');
            $layoutId = $unit->layout_id;

            if($unit->layout->hasParent()) $layoutId = $unit->layout->parent->id;

            $this->info('    Layout ID... ' . $layoutId);
            
            $subscription = Subscription::active()->where('user_id', $unit->user_id)
                ->where('layout_id', $layoutId)
                ->first();

            $this->info('    Subscription... ' . $subscription);

            if(is_null($subscription) || $subscription->days == 0)
            {
                $this->comment('        !!!EXPIRING!!!');
                $unit->expire();
            }
            else
            {
                if( ! is_null($unit->expired_at)) {
                    // unit is expired but the subscription is available
                    // (perhaps, the user bought more from admin after his/her ads were expired)
                    
                    $this->info('        Checking if it can be restored.');
                    $canBeRestored = true;
                    
                    if( ! $subscription->allow_videos) {
                        $componentsWithVideoCount = Component::where('template_id', $unit->template_id)
                            ->where('type', 'video')
                            ->count();

                        if($componentsWithVideoCount > 0)
                        {
                            // subscription does not allow videos but the ad has videos
                            $this->info('            Subscription does not allow videos but the ad has videos.');
                            $canBeRestored = false;
                        }
                    }

                    if( ! is_null($unit->hover_image) // ad has the hover image
                        &&
                        ! ($subscription->allow_hover || $subscription->allow_popout) // but has neither of these two features
                    )
                    {
                        $this->info('            Ad has hover image but the subscription neither allows hover images nor the popouts.');
                        $canBeRestored = false;
                    }

                    if($canBeRestored)
                    {
                        $this->info('        ~~~RESTORING~~~');
                        $unit->restore();
                    }
                    else
                    {
                        $this->comment('        !!!CANNOT BE RESTORED!!!');
                        $unit->restore();
                    }
                }
                $this->info('        Deducting subscription\'s quota by one.');
                $subscription->days = $subscription->days - 1;
                $subscription->save();
            }
        }
    }
}
