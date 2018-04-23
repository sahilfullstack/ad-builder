<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use App\Http\Requests\{ApproveUserRequest};


class AdminController extends Controller
{
    public function approve($userId, ApproveUserRequest $request)
    {
        $userFound = User::find($userId);

        if($request->action == 'approve') 
        {
            $userFound->approved_at = Carbon::now();                
            $userFound->active = 1;                
        }
        else 
        {
            $userFound->rejected_at = Carbon::now();
            $userFound->active = 0;                
        }

        $userFound->save();

        return $userFound->fresh();
    }
}
