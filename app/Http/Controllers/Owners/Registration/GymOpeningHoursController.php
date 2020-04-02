<?php

namespace App\Http\Controllers\Owners\Registration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\GymInfo;use Carbon\Carbon;


class GymOpeningHoursController extends Controller
{
    public function index()
    {
        //
    }

    public function create($gym_id)
    {
        // return $gym_id;
        $gym_info = GymInfo::findOrFail($gym_id);
        return view('owner.registration.gym_closing_hours.create', compact('gym_info'));
        // return 'closing';
    }

    public function store(Request $request)
    {
        // return $request;
        $gym_info = GymInfo::findOrFail($request->gym_id);
        // return $request->mon_open;
        $gym_info->mon_opening = $request->mon_open;
        // return $gym_info->mon_opening;
        $gym_info->mon_closing = $request->mon_close;
        $gym_info->tue_opening = $request->tue_open;
        $gym_info->tue_closing = $request->tue_close;
        $gym_info->wed_opening = $request->wed_open;
        $gym_info->wed_closing = $request->wed_close;
        $gym_info->thu_opening = $request->thu_open;
        $gym_info->thu_closing = $request->thu_close;
        $gym_info->fri_opening = $request->fri_open;
        $gym_info->fri_closing = $request->fri_close;
        $gym_info->sat_opening = $request->sat_open;
        $gym_info->sat_closing = $request->sat_close;
        $gym_info->sun_opening = $request->sun_open;
        $gym_info->sun_closing = $request->sun_close;
        $gym_info->save();
        // return $gym_info;
        return redirect()->route('owner.dashboard.index');
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
