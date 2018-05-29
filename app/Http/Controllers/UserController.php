<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\{Layout};
use App\Http\Requests\{ListUserRequest, CreateUserRequest};
use Carbon\Carbon;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(CreateUserRequest $request)
    {
        return view('users.create');
    }

    public function list(ListUserRequest $request)
    {
        $users = User::with(['role', 'subscriptions'])->latest()->get();       

        return view('users.list_for_approval', compact('users'));
    }

    public function getSubscriptions()
    {
        $user = User::find(auth()->user()->id);
        $subscriptions = $user->subscriptions()->where('expiring_at', '>', Carbon::now())->get();
       
        return view('users.list_subscriptions', compact('subscriptions'));        
    }

    public function getProfile()
    {
        $user = User::find(auth()->user()->id);
       
        return view('users.profile', compact('user'));        
    }

    public function manageSubscription(User $user)
    {
        $subscriptions = $user->subscriptions;

        $layouts = Layout::whereNull('parent_id')->get();

        return view('users.manage_subscription', compact('user', 'subscriptions', 'layouts'));
    }

    public function changePassword()
    {
        return view('users.change_password');        
    }
}
