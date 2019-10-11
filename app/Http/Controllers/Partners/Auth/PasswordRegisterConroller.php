<?php

namespace App\Http\Controllers\Partners\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PasswordRegisterConroller extends Controller
{
    public function index()
    {
        return 'test';
        // return $email;
        // return $access_key;
        $company_user = Auth::user();
        return view('partner.auth.passwordRegister', compact('company_user', 'email', 'access_key'));
    }
}
