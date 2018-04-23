<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AdminController extends Controller
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

    public function listUsersForApproval()
    {
        $users = User::whereNull('approved_at')
                ->whereNull('rejected_at')
                ->get();

        return view('users.list_for_approval', compact('users'));
    }
}
