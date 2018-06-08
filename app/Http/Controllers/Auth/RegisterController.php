<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use App\User, Mail;
use Carbon\Carbon;
use App\Models\Role;
use App\Http\Controllers\Controller;
use App\Mail\{NewRegistrationMailToUser, NewRegistrationMailToAdmin};

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/post-registration';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        // we dont want auto logged in at the time of registration
        // $this->guard()->login($user);

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'username' => 'required|string|min:3|unique:users',
            'company'  => 'required',
            'phone'    => 'required'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        if(User::count() == 0)
        {
            $role = Role::findBySlug('admin');
            $approvedAt = Carbon::now();
            $active = 1;
        }
        else
        {
            $role = Role::findBySlug('advertiser');
            $approvedAt = null;
            $active = 0;
        }

        $user =  User::create([
            'name'        => $data['name'],
            'email'       => $data['email'],
            'company'     => $data['company'],
            'phone'       => $data['phone'],
            'username'    => $data['username'],
            'password'    => bcrypt($data['password']),
            'role_id'     => $role->id,
            'approved_at' => $approvedAt,
            'active'      => $active
        ]);

        // mailing to the user for registering new account
        Mail::to($user->email)->send(new \App\Mail\NewRegistrationMailToUser($user));             

        // mailing to the admin for new registration
        Mail::to(env('ADMIN_EMAIL'))->send(new \App\Mail\NewRegistrationMailToAdmin($user));             

        return $user;
    }
}
