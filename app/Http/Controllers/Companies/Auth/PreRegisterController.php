<?php

namespace App\Http\Controllers\Companies\Auth;

use App\Http\Controllers\Controller;
use App\Models\CompanyUser;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class PreRegisterController extends Controller
{
    use RegistersUsers;

    public function showRegisterForm()
    {
        return view('company.auth.preRegister');
    }

    protected $redirectTo = '/company/register/preRegistered';

    public function __construct()
    {
        $this->middleware('guest:company');
    }

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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:company_users'],
        ]);
    }

    protected function create(array $data)
    {
        return CompanyUser::create([
            'email' => $data['email'],
        ]);
    }

    protected function guard()
    {
        return Auth::guard('company');
    }

    protected function authenticated(Request $request, $user)
    {
        \Log::info('企業担当者 新規登録', ['user_id' => $user->id, 'company_id' => $user->company_id]);    
    }
}
