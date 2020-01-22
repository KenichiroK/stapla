<?php

namespace App\Http\Controllers\Companies\Auth;

use App\Http\Controllers\Controller;
use App\Models\CompanyUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    use RegistersUsers;

    public function showRegisterForm(Request $request)
    {
        $companyUser = CompanyUser::where('email', $request->email)->firstOrFail();

        if(!$companyUser->password){
            return view('company.auth.register', compact('request'));
        }
        if($companyUser->is_agree == 0){
            return redirect()->route('company.register.personal.create', [ "companyUser_id" => $companyUser->id ]);
        } 
        
        return redirect()->route('company.dashboard', compact('companyUser'));
    }

    protected function passwordRegister(Request $request)
    {
        $request->validate([
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
        $company_user = CompanyUser::where('email', $request->email)->firstOrFail();
        $company_user->password           = Hash::make($request->password);
        $company_user->company_id         = $request->company_id;
        $company_user->invitation_user_id = $request->invitation_user_id;
        $company_user->save();

        return redirect()->route('company.register.personal.create', [ 'company_user_id' => $company_user->id ]);
    }
}
