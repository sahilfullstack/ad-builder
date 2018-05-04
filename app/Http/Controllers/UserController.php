<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\{Layout};
use App\Http\Requests\{ListUserRequest};

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

    public function list(ListUserRequest $request)
    {
        $users = User::with(['role', 'subscriptions'])->latest()->get();       

        return view('users.list_for_approval', compact('users'));
    }
}
