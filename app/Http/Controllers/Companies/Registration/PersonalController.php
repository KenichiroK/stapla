<?php

namespace App\Http\Controllers\Companies\Registration;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Companies\CompanyAndCompanyUserRequest;
use App\Http\Requests\Companies\CompanyUserRequest;
use App\Models\CompanyUser;
use App\Models\Company;

class PersonalController extends Controller
{
    public function create($companyUser_id)
    {
        $companyUser = CompanyUser::findOrFail($companyUser_id);
        return view('company/auth/initialRegister/personal', compact('companyUser'));
    }

    public function companyStore(CompanyAndCompanyUserRequest $request)
    {
        $companyUser = CompanyUser::findOrFail($request->companyUser_id);

        if(!isset($companyUser->Company->id)){
            $company = new Company;
        }else {
            $company = Company::findOrFail($companyUser->Company->id);
        }
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
        
        $companyUser->company_id        = $company->id;
        $companyUser->name              = $request->name;
        $companyUser->department        = $request->department;
        $companyUser->occupation        = $request->occupation;
        $companyUser->self_introduction = $request->self_introduction;

        if($request->picture) {
            $time    = date("Y_m_d_H_i_s");
            $picture = $request->picture;
            $pathPicture = \Storage::disk('s3')->putFileAs("company-user-profile", $picture,$time.'_'.$companyUser->id .'.'. $picture->getClientOriginalExtension(), 'public');
            $urlPicture  = \Storage::disk('s3')->url($pathPicture);
        }else {
            $urlPicture  = env('AWS_URL').'/common/dummy_profile_icon.png';
        }
        $companyUser->picture = $urlPicture;
        $companyUser->save();

        return redirect()->route('company.register.terms', [ 'companyUser' => $companyUser->id ]);
        // return redirect()->route('company.register.terms', compact('companyUser'));
    }

    public function terms($companyUser_id)
    {
        $companyUser = CompanyUser::findOrFail($companyUser_id);
        return view('company/auth/initialRegister/terms', compact('companyUser'));
    }

    public function agreeTerms(Request $request)
    {
        $companyUser = CompanyUser::findOrFail($request->companyUser_id);
        return view('company/auth/initialRegister/preview', compact('companyUser', 'request'));
    }

    public function store(CompanyUserRequest $request)
    {
        if($request->picture) {
            $partner = Auth::user();
            $time    = date("Y_m_d_H_i_s");
            $picture = $request->picture;
            $pathPicture = \Storage::disk('s3')->putFileAs("company-user-profile", $picture,$time.'_'.$partner->id .'.'. $picture->getClientOriginalExtension(), 'public');
            $urlPicture  = \Storage::disk('s3')->url($pathPicture);
        }else {
            $urlPicture  = env('AWS_URL').'/common/dummy_profile_icon.png';
        }

        return view('company/auth/initialRegister/preview', compact('request','urlPicture'));
    }
}
