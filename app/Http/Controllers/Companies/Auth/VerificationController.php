<?php

namespace App\Http\Controllers\Companies\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    use VerifiesEmails;

    protected $redirectTo = '/company/auth/firstLogin';

    public function __construct()
    {
        $this->middleware('auth:company');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    public function show(Request $request)
    {
        return $request->user()->hasVerifiedEmail()
                        ? redirect($this->redirectPath())
                        : view('company.auth.verify');
    }

    public function verify(Request $request, $id, $email, $access_key)
    {
        if ($request->route('id') != $request->user()->getKey()) {
            \Log::info('Email認証 例外処理(本人以外)', ['user_id(company)' => $request->user()->getKey()]);
            throw new AuthorizationException('本人しか更新はできません');
        }

        if ($request->user()->hasVerifiedEmail()) {
            return redirect($this->redirectPath());
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return redirect($this->redirectPath())->with('verified', true);
    }
}