<?php

namespace App\Http\Controllers\Partners\Registration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PreRegisterController extends Controller
{
    public function index()
    {
        return view('partner/auth/verify');
    }
}
