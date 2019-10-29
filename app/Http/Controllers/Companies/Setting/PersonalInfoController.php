<?php

namespace App\Http\Controllers\Companies\Setting;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyUser;
use App\Http\Requests\Companies\PersonalRequest;



class PersonalInfoController extends Controller
{
    public function create()
    {
        $auth = Auth::user();
        $company_user = Auth::user();

        return view('/company/setting/personalInfo/create', compact('company_user'));
    }

    public function store(PersonalRequest $request)
    {
        $companyUser = Auth::user();
        
        if($companyUser) {
            \Log::info('個人情報(変更前)', ['user_id(company)' => $companyUser->id]);
            $companyUser->update($request->all());
            \Log::info('個人情報(変更後)', ['user_id(company)' => $companyUser->id]);

            if($request->picture) {
                $time = date("Y_m_d_H_i_s");
                $picture              = $request->picture;
                $pathPicture          = \Storage::disk('s3')->putFileAs("company-user-profile", $picture,$time.'_'.$companyUser->id .'.'. $picture->getClientOriginalExtension(), 'public');
                $companyUser->picture = \Storage::disk('s3')->url($pathPicture);
                $companyUser->save();
                \Log::info('個人情報 写真(変更後)', ['user_id(company)' => $companyUser->id, 'picture' => $companyUser->picture]);
            }
            $completed = '変更を保存しました。';

            return redirect()->route('company.setting.personalInfo.create')->with('completed', $completed);
        }
    }
}
