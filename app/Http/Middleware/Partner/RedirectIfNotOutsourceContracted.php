<?php

namespace App\Http\Middleware\Partner;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotOutsourceContracted
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
        $partner = Auth::user();
        // NOTE: 最初に作成された業務委託契約書のステータスで判断する
        $outsourceContract = $partner->outsourceContracts()->orderBy('created_at', 'desc')->first();

        if (!isset($outsourceContract) || $outsourceContract->status !== 'complete') {
            return redirect()->route('partner.notContract');
        }

        return $next($request);
    }
}
