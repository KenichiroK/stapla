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

class InvitePreRegisterController extends Controller
{
    use RegistersUsers;

    public function showRegisterForm()
    {
        $company_user = Auth::user();
        return view('partner.auth.invitePreRegister', compact('company_user', 'email'));
    }

    protected $redirectTo = '/company/partner';

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        
        event(new Registered($user = $this->create($request->all())));

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath())
                        ->with('completed', '「'.$request->email.'」宛に招待メールを送付しました。');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:partners'],
        ]);
    }

    protected function create(array $data)
    {
        return PartnerAuth::create([
            'email' => $data['email'],
            'company_id' => $data['company_id'],
            'invitation_user_id' => $data['invitation_user_id']
        ]);
    }

    protected function guard()
    {
        return Auth::guard('partner');
    }
}
