<?php

namespace App\Http\Controllers\Partners\Auth;

use App\User;
use App\Http\Controllers\Controller;
use App\Models\PartnerAuth;
use App\Models\CompanyUser;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    public function showRegisterForm()
    {
        // return $email;
        // return $access_key;
        $company_user = Auth::user();
        return view('partner.auth.register', compact('company_user', 'email', 'access_key'));
    }

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/company/partner';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('guest:partner');
    // }

    public function register(Request $request)
    {
        // return $request;
        $this->validator($request->all())->validate();
        // return $request;
        
        event(new Registered($user = $this->create($request->all())));
        // return $user;
        // $this->guard()->login($user);

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
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
            // 'password' => ['required', 'string', 'min:6', 'confirmed'],
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
        $access_key = str_random(16);
        return PartnerAuth::create([
            'email' => $data['email'],
            // 'password' => Hash::make($data['password']),
            'access_key' => $access_key,
            // 'access_key' => 'aa',
            'company_id' => $data['company_id']
        ]);
    }

    protected function guard()
    {
        return Auth::guard('partner');
    }
}
