<?php

namespace App\Http\Controllers\Partners\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    use VerifiesEmails;

    protected $redirectTo = '/partner/auth/firstLogin';

    public function __construct()
    {
        $this->middleware('auth:partner');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    public function show(Request $request)
    {
        return $request->user()->hasVerifiedEmail()
                        ? redirect($this->redirectPath())
                        : view('partner.auth.verify');
    }

    public function verify(Request $request, $id, $email, $access_key)
    {
        if ($request->route('id') != $request->user()->getKey()) {
            \Log::info('Email認証 例外処理(本人以外)', ['user_id(partner)' => $request->user()->getKey()]);
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