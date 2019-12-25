<?php

namespace App\Http\Controllers\Partners;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Partners\PartnerRequest;
use App\Models\Company;
use App\Models\CompanyUser;
use App\Models\Partner;
use App\Notifications\RegisteredPartner;

class InitialRegisterController extends Controller
{
    public function doneVerify()
    {
        $partner = Auth::user();
        if(isset($partner->name)){
            return  redirect('partner/dashboard');
        } else{
            return view('partner/auth/initialRegister/doneVerify', compact('company_id'));
        }
    }

    public function createPartner()
    {
        $partner = Auth::user();
        
        if(isset($partner->name)){
            return  redirect('partner/dashboard');
        } else{
            return view('partner/auth/initialRegister/personal');
        }
    }

    public function preview(PartnerRequest $request)
    {
        if($request->picture) {
            $partner = Auth::user();
            $time    = date("Y_m_d_H_i_s");
            $picture = $request->picture;
            $pathPicture = \Storage::disk('s3')->putFileAs("partner-profile", $picture,$time.'_'.$partner->id .'.'. $picture->getClientOriginalExtension(), 'public');
            $urlPicture  = \Storage::disk('s3')->url($pathPicture);
        } else {
            $urlPicture  = env('AWS_URL').'/common/dummy_profile_icon.png';
        }
        return view('partner/auth/initialRegister/preview', compact('request','urlPicture'));
    }

    public function previwShow(Request $request)
    {
        $partner = Auth::user()->first();
        if(isset($partner->name)){
            return  redirect('partner/dashboard');
        } else{
            return view('partner/auth/initialRegister/preview', compact('request'));
        }
    }

    public function previewStore(Request $request)
    {
        $partner = Auth::user();
        $partner->company_id   = $partner->company_id;
        $partner->name         = $request->name;
        $partner->occupations  = $request->occupations;
        $partner->introduction = $request->introduction;
        $partner->zip_code     = $request->zip_code;
        $partner->prefecture   = $request->prefecture;
        $partner->street       = $request->street;
        $partner->city         = $request->city;
        $partner->building     = $request->building;
        $partner->tel          = $request->tel;
        $partner->introduction = $request->introduction;
        $time = date("Y_m_d_H_i_s");
        $partner->picture      = $request->picture;
        $partner->save();
        \Log::info('パートナー新規登録', ['user_id(partner)' => $partner->id]);

        if (isset($partner->invitationUser)) {
            $partner->invitationUser->notify(new RegisteredPartner($partner));
        }

        return view('partner/auth/initialRegister/done', compact('partner'));
    }

    public function resetPassword()
    {
        return view('partner/inviteRegister/reset-password');
    }
}
