<?php

namespace App\Http\Controllers\Partners\Auth;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use App\Models\CompanyUser;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    // use RegistersUsers;

    public function showRegisterForm(Request $request)
    {
        $partner = Partner::where('email', $request->email)->first();
        if(is_null($partner)) {
            abort(404);
        }

        if(!$partner->password){
            return view('partner.auth.register', compact('request'));
        } elseif($partner->agree_status == 0){
            return redirect()->route('partner.register.intialRegistration.createPartner', [ "partner_id" => $partner->id ]);
        } else{
            return redirect()->route('partner.dashboard', compact('partner'));
        }

    }

    protected $redirectTo = '/partner/register/doneVerify';

    // public function __construct()
    // {
    //     $this->middleware('guest:partner');
    // }

    protected function passwordRegister(Request $request)
    {
        $request->validate([
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
        $partner = Partner::where('email', $request->email)->first();
        if (is_null($partner)) {
            abort(404);
        }
        $partner->password           = Hash::make($request->password);
        $partner->company_id         = $request->company_id;
        $partner->invitation_user_id = $request->invitation_user_id;
        $partner->save();

        return redirect()->route('partner.register.intialRegistration.createPartner', [ 'partner_id' => $partner->id ]);
    }
    
    // protected function guard()
    // {
    //     return Auth::guard('partner');
    // }
}
