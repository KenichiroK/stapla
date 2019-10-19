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
            $companyUser->update($request->all());
            $time = date("Y_m_d_H_i_s");

            if($request->picture) {
                $picture              = $request->picture;
                $pathPicture          = \Storage::disk('s3')->putFileAs("company-user-profile", $picture,$time.'_'.$companyUser->id .'.'. $picture->getClientOriginalExtension(), 'public');
                $companyUser->picture = \Storage::disk('s3')->url($pathPicture);
                $companyUser->save();
            }
            $completed = '変更を保存しました。';

            return redirect()->route('company.setting.personalInfo.create')->with('completed', $completed);
        }
    }
}
