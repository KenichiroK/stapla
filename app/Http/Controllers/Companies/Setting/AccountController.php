<?php

namespace App\Http\Controllers\Companies\Setting;

use Illuminate\Http\Request;
use App\Http\Requests\Companies\UpdateEmailRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\CompanyUser;

class AccountController extends Controller
{
    public function create()
    {
        $company_user = Auth::user();
        return view('company/setting/email/create', compact('company_user'));
    }
    public function sendEmail(UpdateEmailRequest $request)
    {
        $company = Auth::user()->id;
        $token = hash_hmac(
            'sha256',
            $request->session()->get('_token'),
            env('APP_KEY')
        );

        $email = $request->email;
        Mail::to($email)->send(new UpdateEmailCompany($company, $token, $email));

        $completed = '「 '.$email.' 」宛にメールを送信しました。';
        return redirect()->route('company.setting.email.create')->with('completed', $completed);
    }
    public function update(Request $request)
    {
        $session = hash_hmac(
            'sha256',
            $request->session()->get('_token'),
            env('APP_KEY')
        );
        $query = $request->query('token');
        
        if ($session != $query) {
            \Log::info('Email変更 例外処理(本人以外)', ['token' => $request->session()->get('_token')]);
            throw new AuthorizationException('本人しか更新はできません');
        }

        $partner = Partner::findOrFail($request->query('id'));
        $partner->email =  $request->query('email');
        $partner->save();

        $completed = '「 メールアドレスを変更しました。」';
        return redirect()->route('partner.profile.email')->with('completed', $completed);
    }
}
