<?php

namespace App\Http\Controllers\Partners\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PasswordRegisterConroller extends Controller
{
    public function index()
    {
        return view('partner.auth.passwordRegister');
    }
}
