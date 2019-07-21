<?php

namespace App\Http\Controllers\Companies;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InitialRegisterController extends Controller
{
    public function personal()
    {
        return view('company/auth/initialRegister/personal');
    }
}
