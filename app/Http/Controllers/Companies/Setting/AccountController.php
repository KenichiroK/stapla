<?php

namespace App\Http\Controllers\Companies\Setting;

use Illuminate\Http\Request;
use App\Mail\UpdateEmailCompany;
use Mail;
use Carbon\Carbon;
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
        $email = $request->email;
        $token = hash_hmac(
            'sha256',
            str_random(40).$request->session()->get('_token'),
            env('APP_KEY')
        );

        $companyUser = CompanyUser::findOrFail($company);
        $companyUser->temp_email      = $email;
        $companyUser->temp_token      = $token;
        $companyUser->temp_token_time = Carbon::now();
        $companyUser->save();
        
        $limit = Carbon::now()->addHour();
        Mail::to($email)->send(new UpdateEmailCompany($token, $limit));

        $completed = '「 '.$email.' 」宛にメールを送信しました。';
        return redirect()->route('company.setting.email.create')->with('completed', $completed);
    }
    public function updateEmail(Request $request)
    {
        $query = $request->query('token');
        $companyUser = CompanyUser::where('temp_token', $query)->first();
        $hour_ago = Carbon::now()->subHour();

        if(!isset($companyUser->temp_token_time)){
            $completed = '変更するメールアドレスが確認できないため、再度変更手続きをお願いします。';
            return redirect()->route('company.setting.email.create')->with('completed', $completed);
        }elseif($companyUser->temp_token_time < $hour_ago){
            $completed = 'メールアドレス変更可能な有効期限が過ぎたため、再度変更手続きをお願いします。';
            return redirect()->route('company.setting.email.create')->with('completed', $completed);
        }

        $companyUser->email           =  $companyUser->temp_email;
        $companyUser->temp_email      =  NULL;
        $companyUser->temp_token      =  NULL;
        $companyUser->temp_token_time =  NULL;
        $companyUser->save();

        $completed = ' メールアドレスを変更しました。';
        return redirect()->route('company.setting.email.create')->with('completed', $completed);
    }
}
