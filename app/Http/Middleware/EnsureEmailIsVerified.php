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
    public function handle($request, Closure $next, $guard = null)
    {        
        if($guard == 'company') {
            // signin していない場合
            if (!Auth::guard($guard)->check()) {
                return redirect()->route('company/login');
            }

            // メール認証が済んでいない場合
            if (
                !Auth::guard($guard)->user() ||
                (
                    Auth::guard($guard)->user() instanceof MustVerifyEmail &&
                    !Auth::guard($guard)->user()->hasVerifiedEmail()
                )
            ) {
                return $request->expectsJson()
                    ? abort(403, 'Your email address is not verified.')
                    : Redirect::route('company.verification.notice');
            }

            // 規約の同意が済んでいない場合
            if (!auth()->user()->is_agree) {
                return redirect()->route('company.register');
            }

            return $next($request);
        }
    }
}
