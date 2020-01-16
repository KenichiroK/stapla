<?php

namespace App\Http\Controllers\Partners;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Partners\PartnerRequest;
use App\Models\Company;
use App\Models\CompanyUser;
use App\Models\Partner;
use App\Notifications\RegisteredPartner;
use App\Notifications\doneRegisteredPartner;

class InitialRegisterController extends Controller
{

    public function createPartner($partner_id)
    {
        $partner = Partner::findOrFail($partner_id);
        return view('partner/auth/initialRegister/personal', compact('partner'));
    }

    public function terms(PartnerRequest $request)
    {
        $partner = Partner::findOrFail($request->partner_id);
        $partner->name         = $request->name;
        $partner->occupations  = $request->occupations;
        $partner->introduction = $request->introduction;
        $partner->zip_code     = $request->zip_code;
        $partner->prefecture   = $request->prefecture;
        $partner->street       = $request->street;
        $partner->city         = $request->city;
        $partner->building     = $request->building;
        $partner->tel          = $request->tel;
        $partner->introduction = $request->introduction;

        if($request->picture) {
            $time    = date("Y_m_d_H_i_s");
            $picture = $request->picture;
            $pathPicture = \Storage::disk('s3')->putFileAs("partner-profile", $picture, $time.'_'.$partner->id.'.'. $picture->getClientOriginalExtension(), 'public');
            $urlPicture  = \Storage::disk('s3')->url($pathPicture);
        } elseif(!$request->picture) {
            $urlPicture  = env('AWS_URL').'/common/dummy_profile_icon.png';
        }
        $partner->picture = $urlPicture;
        $partner->save();

        return view('partner/auth/initialRegister/terms', compact('partner'));
    }

    public function previewShow(Request $request)
    {
        $partner = Partner::findOrFail($request->partner_id);
        return view('partner/auth/initialRegister/preview', compact('partner'));
    }

    public function previewStore(Request $request)
    {
        $partner = Partner::findOrFail($request->partner_id);
        $partner->agree_status = 1;
        $partner->save();

        \Log::info('パートナー新規登録', ['user_id(partner)' => $partner->id]);

        if (isset($partner->invitationUser)) {
            $partner->invitationUser->notify(new RegisteredPartner($partner));
        }

        $partner->notify(new doneRegisteredPartner($partner));
        // HACK:: ログイン操作なしでDashboardへ
        return redirect()->route('partner.dashboard', compact('partner'));
    }

    public function resetPassword()
    {
        return view('partner/inviteRegister/reset-password');
    }
}
