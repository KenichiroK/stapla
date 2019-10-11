<?php

namespace App\Http\Controllers\Partners\Auth;

namespace App\Http\Controllers\Partners\Auth;
use App\User;
use App\Http\Controllers\Controller;
use App\Models\Partner;
use App\Models\CompanyUser;
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
        // return $request;
        return view('partner.auth.firstLogin', compact('request'));
    }
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/partner/register/doneVerify';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:partner');
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:partners'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
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
