<?php

namespace App\Http\Controllers\Companies;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Mail\CompanyUserMail;
use App\Models\Company;
use App\Models\CompanyUser;


class CompanyUserMailController extends Controller
{
    public function index()
    {
        return view('/company/userMail/index');
    }

    public function send(Request $request)
    {
        Mail::to($request->email)->send(new CompanyUserMail());


        $auth = Auth::user(); 
        $company_id = CompanyUser::where('auth_id', $auth->id)->first()->company_id;
        $companyUsers = CompanyUser::where('company_id', $company_id)->get();

        return view('company/setting/userSetting/create', compact('companyUsers'));
    }
}
