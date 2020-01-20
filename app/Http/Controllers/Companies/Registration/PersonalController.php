<?php

namespace App\Http\Controllers\Companies\Registration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Companies\CompanyAndCompanyUserRequest;
use App\Models\CompanyUser;
use App\Models\Company;
use App\Notifications\RegisteredCompanyUser;
use App\Notifications\doneRegisteredCompanyUser;
use Carbon\Carbon;

class PersonalController extends Controller
{
    public function create($companyUser_id)
    {
        $companyUser = CompanyUser::findOrFail($companyUser_id);
        return view('company/auth/initialRegister/personal', compact('companyUser'));
    }

    public function store(CompanyAndCompanyUserRequest $request)
    {
        $companyUser = CompanyUser::findOrFail($request->companyUser_id);
        $companyUser->name              = $request->name;
        $companyUser->department        = $request->department;
        $companyUser->occupation        = $request->occupation;
        $companyUser->self_introduction = $request->self_introduction;
        if($request->picture) {
            $time    = date("Y_m_d_H_i_s");
            $picture = $request->picture;
            $pathPicture = \Storage::disk('s3')->putFileAs("company-user-profile", $picture,$time.'_'.$companyUser->id .'.'. $picture->getClientOriginalExtension(), 'public');
            $urlPicture  = \Storage::disk('s3')->url($pathPicture);
            $companyUser->picture = $urlPicture;
        }elseif(!$companyUser->picture) {
            $urlPicture  = env('AWS_URL').'/common/dummy_profile_icon.png';
            $companyUser->picture = $urlPicture;
        }

        if(isset($companyUser->invitation_user_id)){ // 企業登録1stユーザー
            $companyUser->save();
            return view('company/auth/initialRegister/preview', compact('companyUser'));
        } else {  // 企業登録2ndユーザー以降
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

            $companyUser->company_id  = $company->id;
            $companyUser->save();

            return redirect()->route('company.register.terms', [ 'companyUser' => $companyUser->id ]);
        }
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

    public function previewStore(Request $request)
    {
        $companyUser = CompanyUser::findOrFail($request->companyUser_id);
        $companyUser->email_verified_at = Carbon::now();
        $companyUser->is_agree = 1;
        $companyUser->save();

        $companyUser->notify(new doneRegisteredCompanyUser($companyUser));

        if(!isset($companyUser->invitation_user_id)) {
            \Log::info('企業新規作成', ['user_id(company)' => $companyUser->id, 'company_id' => $companyUser->Company->id]);
            return view('company/auth/initialRegister/done');
        }

        $invitationUser = CompanyUser::findOrFail($companyUser->invitation_user_id);
        if (isset($invitationUser->id)) {
            \Log::info('担当者新規作成(企業)', ['user_id(company)' => $companyUser->id]);
            $invitationUser->notify(new RegisteredCompanyUser($companyUser));
        }

        $this->middleware('auth:company');
        $this->guard()->login($companyUser);

        return view('company/auth/initialRegister/done');
    }

    protected function guard()
    {
        return Auth::guard('company');
    }
}
