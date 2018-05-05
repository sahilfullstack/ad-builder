<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Subscription};
use App\User;
use App\Exceptions\InvalidInputException;
use Carbon\Carbon;

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
}