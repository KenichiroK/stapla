<?php

namespace App\Http\Controllers\Partners\Setting;

use Illuminate\Http\Request;
use App\Http\Requests\Partners\PartnerNotificationRequest;
use App\Http\Controllers\Controller;

use App\Models\PartnerAccountSetting;
use Illuminate\Support\Facades\Auth;


class NotificationController extends Controller
{
    public function create()
    {
        $partner = Auth::user();
        $setting = PartnerAccountSetting::where('partner_id', $partner->id)->get()->first();

        return view('partner/setting/notification/create', compact('setting'));
    }

    public function store(PartnerNotificationRequest $request)
    {
        $partner = Auth::user();
        $setting = PartnerAccountSetting::where('partner_id', $partner->id)->get()->first();

        if ($setting) {
            \Log::info('パートナー通知設定(変更前)', ['user_id(partner)' => $partner->id]);
            $setting->update($request->all());
            $completed = '変更を保存しました。';
            \Log::info('パートナー通知設定(変更後)', ['user_id(partner)' => $partner->id]);

            return redirect()->route('partner.setting.notification.create')->with('completed', $completed);
        }
        $setting = new PartnerAccountSetting;
        $setting->partner_id         = $partner->id;
        $setting->email_notification = $request->email_notification;
        $setting->daily_mail         = $request->daily_mail;
        $setting->slack              = $request->slack;
        $setting->save();
        $completed = '変更を保存しました。';
        \Log::info('パートナーアカウント 新規作成', ['user_id(partner)' => $partner->id, 'partner_account_setting_id' => $setting->id]);
        
        return redirect()->route('partner.setting.notification.create')->with('completed', $completed);
    }
}
