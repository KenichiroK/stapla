<?php

namespace App\Http\Controllers\Companies\Registration;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Companies\CompanyAndCompanyUserRequest;
use App\Http\Requests\Companies\CompanyUserRequest;
use App\Models\CompanyUser;


class PersonalController extends Controller
{
    public function create()
    {
        $companyUser = Auth::user();
        
        $request = '';

        if(CompanyUser::isRegistered()){
            return redirect('company/dashboard');
        } else{
            return view('company/auth/initialRegister/personal', compact('request', 'companyUser'));
        }
    }

    public function companyStore(CompanyAndCompanyUserRequest $request)
    {
        $auth = Auth::user();
        return view('company/auth/initialRegister/preview', compact('request'));
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
