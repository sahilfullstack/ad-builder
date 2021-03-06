<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use App\Http\Requests\{ApproveUserRequest, UpdateUserRequest, StoreUserRequest, UpdateUserPasswordRequest, DeleteUserRequest};
use App\Exceptions\{CustomInvalidInputException};
use Mail, DB;
use App\Models\{Layout, Role};
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function create(StoreUserRequest $request)
    {
        $role = Role::findBySlug($request->role);          

        if(is_null($role))
        {
             throw new CustomInvalidInputException('role', 'Role is invaid.');
        }

        $password = str_random(6);

        $user = User::create([
            'name'          => $request->get('name'),
            'email'         => $request->get('email'),
            'company'       => $request->get('company'),
            'phone'         => $request->get('phone'),
            'username'      => $request->get('username'),
            'password'      => bcrypt($password),
            'role_id'       => $role->id,
            'approved_at'   => Carbon::now(),
            'active'        => 1,
            'temp_password' => 1
        ]);

        // mail user the username and password
        Mail::to($user->email)->send(new \App\Mail\AccountCreatedMailToUser($user, $password));             

        return $user;
    }

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

    public function updateProfile(User $user, UpdateUserRequest $request)
    {
        $user->name    = $request->get('name');
        $user->city    = $request->get('city');
        $user->email   = $request->get('email');
        $user->phone   = $request->get('phone');
        $user->state   = $request->get('state');
        $user->company = $request->get('company');
        $user->address = $request->get('address');
        $user->pin     = $request->get('pin');
        
        $user->save();
    }    

    public function updatePassword(UpdateUserPasswordRequest $request)
    {
        $user                = auth()->user();
        $user->password      = bcrypt($request->get('password'));
        $user->temp_password = 0;
        $user->save();
        
        return $user;
    }

    public function delete(User $user, DeleteUserRequest $request)
    {
        $user->delete();

        return $user->fresh();       
    }
}
