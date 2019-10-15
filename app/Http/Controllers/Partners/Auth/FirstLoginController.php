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

class FirstLoginController extends Controller
{
    use RegistersUsers;
    public function showRegisterForm(Request $request)
    {
        return view('partner.auth.firstLogin', compact('request'));
    }

    protected $redirectTo = '/partner/register/doneVerify';

    public function __construct()
    {
        $this->middleware('guest:partner');
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);
        

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:partners'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        return Partner::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'company_id' => $data['company_id'],
        ]);
    }
    protected function guard()
    {
        return Auth::guard('partner');
    }
}
