<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        return view('dashboard.home');
    }    

    public function accessToken()
    {
        return view('dashboard.access_token');
    }
}
