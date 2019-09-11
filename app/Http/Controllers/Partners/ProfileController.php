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

            if ($request->picture) {
                $partner->picture = $request->picture->storeAs('public/images/partner/profile', $time.'_'.Auth::user()->id . $request->picture->getClientOriginalExtension());
                $partner->save();
            }
            $completed = '変更を保存しました。';

            return redirect()->route('partner.profile.create')->with('completed', $completed);
        }
    }
}
