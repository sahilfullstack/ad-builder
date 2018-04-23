<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        dd(auth()->user());

        if (
                ! Auth::guard($guard)->check() or 
                ! in_array(auth()->user()->id, json_decode(env('ADMIN_USERS'), true))
        ) {
            return redirect('/');
        }

        return $next($request);
    }
}
