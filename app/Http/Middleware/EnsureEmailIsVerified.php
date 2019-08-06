<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class EnsureEmailIsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $guards = array_keys(config('auth.guards'));

        foreach($guards as $guard) {
            if($guard == 'company') {
                if (Auth::guard($guard)->check()) {
                    if (! Auth::guard($guard)->user() ||
                        (Auth::guard($guard)->user() instanceof MustVerifyEmail &&
                        ! Auth::guard($guard)->user()->hasVerifiedEmail())) {
                        // dd('ddd');
                        return $request->expectsJson()
                                ? abort(403, 'Your email address is not verified.')
                                : Redirect::route('company.verification.notice');
                    }  
                }
            }
        }
        return $next($request);
    }
}
