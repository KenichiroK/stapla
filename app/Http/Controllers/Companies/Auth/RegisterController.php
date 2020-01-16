<?php

namespace App\Http\Controllers\Companies\Auth;

use App\Http\Controllers\Controller;
use App\Models\CompanyUser;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    use RegistersUsers;

    public function showRegisterForm(Request $request)
    {
        $companyUser = CompanyUser::where('email', $request->email)->first();
        if(is_null($companyUser)) {
            abort(404);
        }

        if(!$companyUser->password){
            return view('company.auth.register', compact('request'));
        } elseif($companyUser->agree_status == 0){
            return redirect()->route('company.register.personal.create', [ "companyUser_id" => $companyUser->id ]);
        } else{
            return redirect()->route('company.dashboard', compact('companyUser'));
        }

        return view('company.auth.register', compact('request'));
    }

    protected $redirectTo = '/company/register/doneVerify';

    // protected function validator(array $data)
    // {
    //     return Validator::make($data, [
    //         'email' => ['required', 'string', 'email', 'max:255', 'unique:company_users'],
    //         'password' => ['required', 'string', 'min:6', 'confirmed'],
    //     ]);
    // }

    protected function pwRegister(Request $request)
    {
        $request->validate([
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
        $company_user = CompanyUser::where('email', $request->email)->first();
        if (is_null($company_user)) {
            abort(404);
        }
        $company_user->password           = Hash::make($request->password);
        $company_user->company_id         = $request->company_id;
        $company_user->invitation_user_id = $request->invitation_user_id;
        $company_user->save();

        return redirect()->route('company.register.personal.create', [ 'company_user_id' => $company_user->id ]);
    }

    // protected function create(array $data)
    // {
    //     return CompanyUser::create([
    //         'email' => $data['email'],
    //         'password' => Hash::make($data['password']),
    //         'company_id' => $data['company_id'],
    //         'invitation_user_id' => $data['invitation_user_id'] ?? null,
    //     ]);
    // }

    // protected function guard()
    // {
    //     return Auth::guard('company');
    // }
}
