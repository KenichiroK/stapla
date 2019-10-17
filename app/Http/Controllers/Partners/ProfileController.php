<?php

namespace App\Http\Controllers\Partners;

use Illuminate\Http\Request;
use App\Http\Requests\Partners\ProfileRequest;
use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function create()
    {
        $auth_id = Auth::user()->id;
        $partner = Partner::where('partner_id', $auth_id)->get()->first();
        $completed = '';

        return view('partner/profile/create', compact(['partner', 'completed']));
    }

    public function store(ProfileRequest $request)
    {
        $auth_id = Auth::user()->id;
        $partner = Partner::where('partner_id', $auth_id)->get()->first();
        if ($partner) {
            $partner->update($request->all());
            $time = date("Y_m_d_H_i_s");

            if($request->picture) {
                $picture          = $request->picture;
                $path_picture     = \Storage::disk('s3')->putFileAs($auth_id, $picture,$time.'_'.$auth_id .'.'. $picture->getClientOriginalExtension(), 'public');
                $partner->picture = \Storage::disk('s3')->url($path_picture);
                $partner->save();
            }
            
            $completed = '変更を保存しました。';

            return redirect()->route('partner.setting.profile.create')->with('completed', $completed);
        }
    }
}
