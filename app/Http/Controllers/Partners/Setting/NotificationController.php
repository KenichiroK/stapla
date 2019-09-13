<?php

namespace App\Http\Controllers\Partners\Setting;

use Illuminate\Http\Request;
use App\Http\Requests\Partners\PartnerNotificationRequest;
use App\Http\Controllers\Controller;
use App\Models\Partner;
use App\Models\PartnerAccountSetting;
use Illuminate\Support\Facades\Auth;


class NotificationController extends Controller
{
    public function create()
    {
        $auth_id = Auth::user()->id;
        $partner = Partner::where('partner_id', $auth_id)->get()->first();
        $setting = PartnerAccountSetting::where('partner_id', $partner->id)->get()->first();

        $completed = '';
        return view('partner/setting/notification/create', compact('partner', 'setting', 'completed'));
    }

    public function store(PartnerNotificationRequest $request)
    {
        $auth_id = Auth::user()->id;
        $partner = Partner::where('partner_id', $auth_id)->get()->first();
        $setting = PartnerAccountSetting::where('partner_id', $partner->id)->get()->first();

        if ($setting) {
            $setting->update($request->all());
            $completed = '変更を保存しました。';

            return redirect()->route('partner.setting.notification.create')->with('completed', $completed);
        }
        $setting = new PartnerAccountSetting;
        $setting->partner_id         = $partner->id;
        $setting->email_notification = $request->email_notification;
        $setting->daily_mail         = $request->daily_mail;
        $setting->slack              = $request->slack;
        $setting->save();
        $completed = '変更を保存しました。';
        
        return redirect()->route('partner.setting.notification.create')->with('completed', $completed);
    }
}
