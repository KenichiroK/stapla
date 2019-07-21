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

    public function company()
    {
        return view('company/auth/initialRegister/company');
    }

    public function preview()
    {
        return view('company/auth/initialRegister/preview');
    }

    public function done()
    {
        return view('company/auth/initialRegister/done');
    }
}
