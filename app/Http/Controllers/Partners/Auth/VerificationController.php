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

    // protected $redirectTo = '/partner/register/doneVerify';
    protected $redirectTo = '/partner/auth/firstLogin';

    public function __construct()
    {
        $this->middleware('auth:partner');
        $this->middleware('signed')->only('verify');
        // $this->middleware('throttle:6,1')->only('verify', 'resend');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    // public function show(Request $request)
    // {
    //     return $request->user()->hasVerifiedEmail()
    //                     ? redirect($this->redirectPath())
    //                     : view('partner.auth.verify');
    // }

    // こちらの処理は認証クリックしてログインを通過した後に通る
    // 違う！
    // ↓ 間違っていいます。
    // web.phpの
    // Route::middleware('signed')->get('email/verify/{id}','Partners\Auth\VerificationController@verify')->name('partner.verification.verify');
    // ここのmiddlewareが入っていたからloginページに遷移していいた。
    // 流石にそろそろmiddlewareを分かるように！
    public function verify(Request $request, $id, $email, $access_key)
    {
        // return $id;
        // return $email;
        // return $access_key;
        // return $request;
        // return $request;
        return $request->user()->getKey();

        return $request->route('id');
        if ($request->route('id') != $request->user()->getKey()) {
            throw new AuthorizationException('本人しか更新はできません');
        }

        // return dd($request);

        if ($request->user()->hasVerifiedEmail()) {
            // return redirect($this->redirectPath());
            return redirect($this->redirectPath());
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return redirect($this->redirectPath())->with('verified', true);
        // return view('partner.auth.passwordRegister');
    }
}