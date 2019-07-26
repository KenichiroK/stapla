<?php

namespace App\Http\Controllers\Companies;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\CompanyUser;
use Illuminate\Support\Facades\Auth;

class InitialRegisterController extends Controller
{
    public function personal()
    {
        return view('company/auth/initialRegister/personal');
    }

    public function StorePersonal()
    {
        return  $auth = Auth::user();
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

    public function invite()
    {
        $auth_id = Auth::user()->id;
        $company_user = CompanyUser::where('auth_id', $auth_id)->get()->first();
        return view('company/invite/company/create', compact('company_user'));
    }

    public function resetPassword()
    {
        return view('company/inviteRegister/reset-password'); 
    }
}
