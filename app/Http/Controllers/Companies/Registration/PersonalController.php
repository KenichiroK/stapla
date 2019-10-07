<?php

namespace App\Http\Controllers\Companies\Registration;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Companies\CompanyAndCompanyUserRequest;
use App\Models\CompanyUser;


class PersonalController extends Controller
{
    public function create()
    {
        // return $auth = Auth::user();
        $companyUser = Auth::user();
        
        $request = '';

        return 'test';
        if(isset($companyUser)){
            return redirect('company/dashboard');
        } else{
            return view('company/auth/initialRegister/personal', compact('request'));
        }
    }

    public function store(CompanyAndCompanyUserRequest $request)
    {
        // return $request;
        $auth = Auth::user();
        return view('company/auth/initialRegister/preview', compact('request'));
    }
}
