<?php

namespace App\Http\Controllers\Companies;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\CompanyUser;

class InitialRegisterController extends Controller
{
    public function personal()
    {
        return view('company/auth/initialRegister/personal');
    }

    public function StorePersonal()
    {
        $auth = Auth::user();
        return redirect('/company/previewInfo');
    }

    public function preview()
    {
        return view('company/auth/initialRegister/preview');
    }

    public function done()
    {
        return view('company/auth/initialRegister/done');
    }

    public function company()
    {
        return view('company/auth/initialRegister/company');
    }
}
