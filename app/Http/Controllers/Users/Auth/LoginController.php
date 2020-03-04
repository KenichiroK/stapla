<?php

namespace App\Http\Controllers\Users\Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    
    public function index()
    {
        return view('user.auth.login');
    }
    
    protected function guard()
    {
        return Auth::guard('user');
    }
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/user/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:user')->except('logout');
    }

    public function logout(Request $request) {
        $this->guard('user')->logout();
        return redirect('/user/login');
    }

    protected function authenticated(Request $request, $user)
    {
        // \Log::info('ログイン(campany)', ['user_id' => $user->id, 'company_id' => $user->company_id]);    
    }

    
}
