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

class InviteRegisterController extends Controller
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


    public function index()
    {
        $company_user = Auth::user();
        return view('company.auth.inviteRegister', compact('company_user'));
    }
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/company/setting/userSetting';

   

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    //  guestの時だけ通す
    // public function __construct()
    // {
    //     $this->middleware('guest:company');
    // }

    public function register(Request $request)
    {
        // return $request;
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        // $this->guard()->login($user);

        // return $this->registered($request, $user)
        //                 ?: redirect($this->redirectPath());
        return redirect()->route('company.setting.userSetting.create');
    }

    // /**
    //  * Get a validator for an incoming registration request.
    //  *
    //  * @param  array  $data
    //  * @return \Illuminate\Contracts\Validation\Validator
    //  */

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:company_users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    // /**
    //  * Create a new user instance after a valid registration.
    //  *
    //  * @param  array  $data
    //  * @return \App\Models\CompanyUserAuth
    //  */
    protected function create(array $data)
    {
        return CompanyUser::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'company_id' => $data['company_id'],
        ]);
    }

    protected function guard()
    {
        return Auth::guard('company');
    }
}
