<?php

namespace App\Http\Controllers\Partners\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\PartnerVerifiesEmails;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    use PartnerVerifiesEmails;

    protected $redirectTo = '/partner/register/doneVerify';

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
                        : view('partner.auth.veryfy');
    }
}
