<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use App\Http\Requests\{ApproveUserRequest};
use Mail;

class UserController extends Controller
{
    public function approve($userId, ApproveUserRequest $request)
    {
        $userFound = User::find($userId);

        if($request->action == 'approve') 
        {
            $userFound->approved_at = Carbon::now();                
            $userFound->active = 1;   
            Mail::to($userFound->email)->send(new \App\Mail\AccountApprovalMailToUser($userFound));             
        }
        else 
        {
            $userFound->rejected_at = Carbon::now();
            $userFound->active = 0;                
            Mail::to($userFound->email)->send(new \App\Mail\AccountRejectionMailToUser($userFound));             
        }

        $userFound->save();

        return $userFound->fresh();
    }
}
