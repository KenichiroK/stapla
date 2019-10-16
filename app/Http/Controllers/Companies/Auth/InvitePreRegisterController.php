<?php

namespace App\Http\Controllers\Companies\Auth;

use App\Http\Controllers\Controller;
use App\Models\CompanyUserAuth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class InvitePreRegisterController extends Controller
{
    use RegistersUsers;

    public function showRegisterForm()
    {
        return view('company.auth.invitePreRegister');
    }
    
    protected $redirectTo = '/company/setting/userSetting';

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);
    }

    protected function create(array $data)
    {
        return CompanyUserAuth::create([
            'email' => $data['email'],
            'company_id' => $data['company_id'],
        ]);
    }

    protected function guard()
    {
        return Auth::guard('company');
    }
}
