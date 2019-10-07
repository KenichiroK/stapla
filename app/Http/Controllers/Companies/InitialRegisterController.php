<?php

namespace App\Http\Controllers\Companies;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Companies\CompanyAndCompanyUserRequest;
use App\Models\Company;
use App\Models\CompanyUser;

class InitialRegisterController extends Controller
{
    public function doneVerify()
    {
        $company_user = Auth::user();
        
        if(isset($company_user)){
            return  redirect('company/dashboard');
        } else{
            return view('company/auth/initialRegister/doneVerify' ,compact('company_user'));
        }
    }
}
