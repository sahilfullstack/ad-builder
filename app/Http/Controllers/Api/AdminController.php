<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function approve($userId, Request $request)
    {
        $userFound = User::find($userId);

        if($request->action == 'approve') 
        {
            $userFound->approved_at = Carbon::now();                
        }
        else 
        {
            $userFound->rejected_at = Carbon::now();
        }

        $userFound->save();

        return $userFound->fresh();
    }
}
