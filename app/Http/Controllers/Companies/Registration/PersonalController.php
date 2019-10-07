<?php

namespace App\Http\Controllers\Companies\Registration;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Companies\CompanyAndCompanyUserRequest;
use App\Http\Requests\Companies\CompanyUserRequest;
use App\Models\CompanyUser;


class PersonalController extends Controller
{
    public function create()
    {
        $companyUser = Auth::user();
        
        $request = '';

        if(isset($companyUser->name)){
            return redirect('company/dashboard');
        } else{
            return view('company/auth/initialRegister/personal', compact('request', 'companyUser'));
        }
    }

    public function companyStore(CompanyAndCompanyUserRequest $request)
    {
        $auth = Auth::user();
        return view('company/auth/initialRegister/preview', compact('request'));
    }

    public function store(CompanyUserRequest $request)
    {
        $auth = Auth::user();
        return view('company/auth/initialRegister/preview', compact('request'));
    }
}
