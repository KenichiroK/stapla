<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class PartnerEnsureEmailIsVerified
{
    public function handle($request, Closure $next, $guard = null)
    {        
        if($guard == "partner" && Auth::guard($guard)->check() && auth()->user()->is_agree == 1) {
            return $next($request);
        } elseif($guard == 'partner' && Auth::guard($guard)->check()) {
            if (! Auth::guard($guard)->user() ||
                 (Auth::guard($guard)->user() instanceof MustVerifyEmail && ! Auth::guard($guard)->user()->hasVerifiedEmail())) {
                
                    return $request->expectsJson()
                        ? abort(403, 'Your email address is not verified.')
                        : Redirect::route('partner.verification.notice');
            }
        } else{
            return redirect('/');
        }
    }
}
