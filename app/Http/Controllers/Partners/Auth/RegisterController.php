<?php

namespace App\Http\Controllers\Partners\Auth;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegisterForm(Request $request)
    {
        $partner = Partner::where('email', $request->email)->firstOrFail();

        if(!$partner->password){
            return view('partner.auth.register', compact('request'));
        }
        if($partner->is_agree == 0){
            return redirect()->route('partner.register.personal.create', [ "partner_id" => $partner->id ]);
        }

        return redirect()->route('partner.dashboard', compact('partner'));
    }

    protected $redirectTo = '/partner/register/doneVerify';

    protected function passwordRegister(Request $request)
    {
        $request->validate([
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
        $partner = Partner::where('email', $request->email)->firstOrFail();
        $partner->password           = Hash::make($request->password);
        $partner->company_id         = $request->company_id;
        $partner->invitation_user_id = $request->invitation_user_id;
        $partner->save();

        return redirect()->route('partner.register.personal.create', [ 'partner_id' => $partner->id ]);
    }
}
