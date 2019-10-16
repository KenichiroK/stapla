<?php

namespace App\Http\Controllers\Companies\Registration;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyUser;

class PreviewController extends Controller
{
    public function create()
    {
        $companyUser = Auth::user();
        $request = '';
        

        if(CompanyUser::isRegistered()){
            return  redirect('company/dashboard');
        } else{
            return view('company/auth/initialRegister/preview', compact('request'));
        }
    }

    public function companyStore(Request $request)
    {
        $companyUser = Auth::user();
        
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

        $companyUser->company_id = $company->id;
        $companyUser->name = $request->name;
        $companyUser->department = $request->department;
        $companyUser->occupation = $request->occupation;
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
    
    public function store(Request $request)
    {
        $companyUser = Auth::user();

        $companyUser->name = $request->name;
        $companyUser->department = $request->department;
        $companyUser->occupation = $request->occupation;
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
}
