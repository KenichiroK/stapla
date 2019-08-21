<?php

namespace App\Http\Controllers\Partners;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Companies\CompanyAndCompanyUserRequest;
use App\Models\Company;
use App\Models\Partner;

class InitialRegisterController extends Controller
{
    public function preRegisteredShow()
    {
        return view('partner/auth/verify');
    }
    public function doneVerifyShow()
    {
        return view('partner/auth/initialRegister/doneVerify', compact('company_id'));
    }

    public function createPartner()
    {
        // return Auth::user(); 
        return view('partner/auth/initialRegister/personal');
    }

    public function toCreatePartner(Request $request)    
    {
        return view('partner/auth/initialRegister/personal', compact('request'));
    }

    public function preview(Request $request)
    {
        return Auth::user();
    }

    // public function toPreview(Request $request)
    // {
    //     return $request;
    //     // $partnerAuth = Auth::user();
    //     return view('partner/auth/initialRegister/preview', compact('request'));
    // }

    public function previwShow(Request $request)
    {
        $partnerAuth = Auth::user();
        return view('partner/auth/initialRegister/preview', compact('request'));
    }

    public function previewStore(Request $request)
    {
        return $partnerAuth = Auth::user();
        
        $partner = new Partner;
        $partner->partner_id = $partnerAuth->id;
        $partner->company_id = $request->company_id;
        $partner->name = $request->name;
        $partner->zip_code = $request->zip_code;
        $partner->prefecture = $request->prefecture;
        $partner->city = $request->city;
        $partner->building = $request->building;
        $partner->tel = $request->tel;
        $partner->introduction = $request->introduction;
        $time = date("Y_m_d_H_i_s");
        if(isset($request->picture)){
            $partner->picture = $request->picture->storeAs('public/images/partner/profile', $time.'_'.Auth::user()->id . $request->picture->getClientOriginalExtension());
        }else {
            $partner->picture ='public/images/default/dummy_user.jpeg';
        }
        $partner->save();

        return view('partner/auth/initialRegister/done');
    }

    public function done()
    {
        return view('partner/auth/regitster/done');
    }

    public function resetPassword()
    {
        return view('partner/inviteRegister/reset-password'); 
    }
}
