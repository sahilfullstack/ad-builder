<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use App\Http\Requests\{ApproveUserRequest};
use Mail, DB;
use App\Models\{Layout};

class UserController extends Controller
{
    public function approve($userId, ApproveUserRequest $request)
    {
        try
        {         
            $userFound = User::find($userId);

            DB::beginTransaction();

            if($request->action == 'approve') 
            {
                $userFound->approved_at = Carbon::now();                
                $userFound->active = 1;  

                $layouts = Layout::notDeleted()->get();     
                Mail::to($userFound->email)->send(new \App\Mail\AccountApprovalMailToUser($userFound));             
            }
            else 
            {
                $userFound->rejected_at = Carbon::now();
                $userFound->active = 0;                
                Mail::to($userFound->email)->send(new \App\Mail\AccountRejectionMailToUser($userFound));             
            }

            $userFound->save();
            DB::commit();

            return $userFound->fresh();
        }
        catch(\Exception $e)
        {
            DB::rollBack();
            \Log::info($e);
        }
    }
}
