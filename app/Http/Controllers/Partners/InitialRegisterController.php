<?php

namespace App\Http\Controllers\Partners;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Partners\PartnerRequest;
use App\Models\Company;
use App\Models\Partner;

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
        return view('partner/auth/initialRegister/preview', compact('request'));
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
        $partner->picture      ='public/images/default/dummy_user.jpeg';
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
