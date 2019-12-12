<?php

namespace App\Http\Controllers\Partners;

use Illuminate\Http\Request;
use App\Mail\UpdateEmailPartner;
use Mail;
use Carbon\Carbon;
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
        $email = $request->email;
        $token = hash_hmac(
            'sha256',
            $request->session()->get('_token'),
            env('APP_KEY')
        );
        $partner = Partner::findOrFail($partner);
        $partner->temp_email      = $email;
        $partner->temp_token      = $token;
        $partner->temp_token_time = Carbon::now();
        $partner->save();
        
        $limit = Carbon::now()->addHour();
        Mail::to($email)->send(new UpdateEmailPartner($token, $limit));

        $completed = '「 '.$email.' 」宛にメールを送信しました。';
        return redirect()->route('partner.profile.email')->with('completed', $completed);
    }

    public function updateEmail(Request $request)
    {
        $query = $request->query('token');
        $partner = Partner::where('temp_token', $query)->first();
        $hour_ago = Carbon::now()->subHour();

        if(!isset($partner->temp_token_time)){
            $completed = '変更するメールアドレスが確認できないため、再度変更手続きをお願いします。';
            return redirect()->route('partner.profile.email')->with('completed', $completed);
        }elseif($partner->temp_token_time < $hour_ago){
            $completed = 'メールアドレス変更可能な有効期限が過ぎたため、再度変更手続きをお願いします。';
            return redirect()->route('partner.profile.email')->with('completed', $completed);
        }

        $partner->email           =  $partner->temp_email;
        $partner->temp_email      =  NULL;
        $partner->temp_token      =  NULL;
        $partner->temp_token_time =  NULL;
        $partner->save();

        $completed = 'メールアドレスを変更しました。';
        return redirect()->route('partner.profile.email')->with('completed', $completed);
    }
}
