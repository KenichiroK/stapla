<?php

namespace App\Http\Controllers\Owners\Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    
    public function index()
    {
        return view('owner/auth/login');
    }
    
    protected function guard()
    {
        return Auth::guard('owner');
    }
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/owner/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:owner')->except('logout');
    }

    public function logout(Request $request) {
        $this->guard('owner')->logout();
        return redirect('/owner/login');
    }

    protected function authenticated(Request $request, $user)
    {
        // \Log::info('ログイン(campany)', ['user_id' => $user->id, 'company_id' => $user->company_id]);    
    }
}
