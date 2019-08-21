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
    public function preRegisteredShow()
    {
        return view('company/auth/verify');
    }

    public function doneRegisteredShow()
    {

        return view('/company/dashboard');
    }

    public function doneVerifyShow()
    {
        $auth = Auth::user();
        $companyUser = CompanyUser::where('auth_id', $auth->id)->first();

        return view('company/auth/initialRegister/doneVerify' ,compact('companyUser'));
    }

    public function create()
    {
        $auth = Auth::user();
        $request = '';
        return view('company/auth/initialRegister/personal', compact('request'));
    }

    public function toPreview(CompanyAndCompanyUserRequest $request)
    {
        $auth = Auth::user();
        return view('company/auth/initialRegister/preview', compact('request'));
    }

    public function previwShow(Request $request)
    {
        $auth = Auth::user();
        return view('company/auth/initialRegister/preview', compact('request'));
    }

    public function previewStore(Request $request)
    {
        $auth = Auth::user();
        
        $company = new Company;
        $company->company_name           = $request->company_name;
        $company->representive_name      = $request->representive_name;
        $company->zip_code               = $request->zip_code;
        $company->address_prefecture     = $request->address_prefecture;
        $company->address_city           = $request->address_city;
        $company->address_building       = $request->address_building;
        $company->tel                    = $request->tel;
        $company->expire                 = true;
        $company->approval_setting       = true;
        $company->income_tax_setting     = true;
        $company->remind_setting         = true;
        $company->purchase_order_setting = true;
        $company->confidential_setting   = true;
        $company->account_setting        = true;
        $company->save();

        $companyUser = new CompanyUser;
        $companyUser->auth_id = $auth->id;
        $companyUser->company_id = $company->id;
        $companyUser->name = $request->name;
        $companyUser->department = $request->department;
        $companyUser->self_introduction = $request->self_introduction;
        $time = date("Y_m_d_H_i_s");
        if(isset($request->picture)){
            $companyUser->picture = $request->picture->storeAs('public/images/companyUser/profile', $time.'_'.Auth::user()->id . $request->picture->getClientOriginalExtension());
        }else {
            $companyUser->picture ='public/images/default/dummy_user.jpeg';
        }
        
        $companyUser->save();

        return view('company/auth/initialRegister/done');
    }
    
    public function done()
    {
        return view('company/auth/regitster/done');
    }

    public function company()
    {
        return view('company/auth/initialRegister/company');
    }
}
