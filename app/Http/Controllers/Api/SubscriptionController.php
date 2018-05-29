<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Subscription};
use App\User;
use App\Exceptions\InvalidInputException;
use Carbon\Carbon;
use App\Http\Requests\Subscription\CreateSubscriptionRequest;

class SubscriptionController extends Controller
{
    public function update(User $user, Subscription $subscription, Request $request)
    {
        $subscription = Subscription::where([
            'id'      => $subscription->id,
            'user_id' => $user->id
        ])->first();

        $subscription->expiring_at      = Carbon::parse($request->expiry_date);
        $subscription->allowed_quantity = $request->allowed_quantity;

        $subscription->save();

        return $subscription->fresh();
    }

    public function create(CreateSubscriptionRequest $request, User $user)
    {
         $subscription = new Subscription([
                'user_id'          => $user->id,
                'layout_id'        => $request->layout_id,
                'allowed_quantity' => $request->allowed_quantity,
                'allow_videos'     => $request->allow_videos,
                'allow_hover'      => $request->allow_hover,
                'allow_popout'     => $request->allow_popout,
                'days'             => $request->days,
                'expiring_at'      => Carbon::parse($request->expiring_at),
                'created_at'       => Carbon::now(),
                'updated_at'       => Carbon::now()
            ]);

        $subscription->save();

        return $subscription->fresh();
    }
}