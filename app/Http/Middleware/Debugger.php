<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Jobs\Debugger\PerformDebuggingJob;

class Debugger
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
        $hasBug = debug_mesa();
        
        if (
            $hasBug
        ) {
            $job = new PerformDebuggingJob;
            return $job->handle($hasBug);
        }

        return $next($request);
    }
}
