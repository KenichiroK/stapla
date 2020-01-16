<?php

namespace App\Http\Controllers\Companies\Registration;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyUser;
use App\Notifications\RegisteredCompanyUser;
use App\Notifications\doneRegisteredCompanyUser;

class PreviewController extends Controller
{
    // public function create()
    // {
    //     if(CompanyUser::isRegistered()){
    //         return  redirect('company/dashboard');
    //     } else{
    //         return view('company/auth/initialRegister/preview', compact('request'));
    //     }
    // }

    public function companyStore(Request $request)
    {
        $companyUser = CompanyUser::findOrFail($request->companyUser_id);
        $companyUser->agree_status = $request->agree_status;
        $companyUser->save();
        \Log::info('企業新規作成', ['user_id(company)' => $companyUser->id, 'company_id' => $companyUser->Company->id]);

        $companyUser->notify(new doneRegisteredCompanyUser($companyUser));

        return view('company/auth/initialRegister/done');
    }

    public function store(Request $request)
    {
        $companyUser = Auth::user();

        $companyUser->name = $request->name;
        $companyUser->department = $request->department;
        $companyUser->occupation = $request->occupation;
        $companyUser->self_introduction = $request->self_introduction;
        $companyUser->picture = $request->picture;
        $companyUser->save();
        \Log::info('担当者新規作成(企業)', ['user_id(company)' => $companyUser->id]);

        if (!isset($companyUser->invitation_user_id)) {
            return view('company/auth/initialRegister/done');
        }

        $invitationUser = CompanyUser::where('id', $companyUser->invitation_user_id)->first();
        if (isset($invitationUser->id)) {
            $invitationUser->notify(new RegisteredCompanyUser($companyUser));
        }

        $companyUser->notify(new doneRegisteredCompanyUser($companyUser));

        return view('company/auth/initialRegister/done');
    }
}
