<?php

namespace App\Http\Controllers\Partners;

use Illuminate\Http\Request;
use App\Mail\ChangeEmail;
use Mail;
use App\Http\Requests\Partners\ProfileRequest;
use App\Http\Requests\Partners\UpdateEmailRequest;
use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function create()
    {
        return view('partner/profile/create');
    }

    public function store(ProfileRequest $request)
    {
        $partner = Auth::user();
        if ($partner) {
            $partner->update($request->all());
            $time = date("Y_m_d_H_i_s");

            if($request->picture) {
                $picture          = $request->picture;
                $pathPicture      = \Storage::disk('s3')->putFileAs("partner-profile", $picture,$time.'_'.$partner->id .'.'. $picture->getClientOriginalExtension(), 'public');
                $partner->picture = \Storage::disk('s3')->url($pathPicture);
                $partner->save();
                
                \Log::info('アイコン画像登録(partner)', ['user_id(partner)' => $partner->id, 'picture' => $partner->picture]);
            }
            
            $completed = '変更を保存しました。';

            return redirect()->route('partner.profile.create')->with('completed', $completed);
        }
    }

    public function email(Request $request)
    {
        return view('partner/profile/email');
    }
    
    public function sendMail(UpdateEmailRequest $request)
    {
        $partner = Auth::user()->id;
        $token = hash_hmac(
            'sha256',
            $request->session()->get('_token'),
            env('APP_KEY')
        );

        $email = $request->email;
        Mail::to($email)->send(new ChangeEmail($partner, $token, $email));

        $completed = '「 '.$email.' 」宛にメールを送信しました。';
        return redirect()->route('partner.profile.email')->with('completed', $completed);
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
