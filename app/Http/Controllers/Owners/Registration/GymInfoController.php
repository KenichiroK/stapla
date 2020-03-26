<?php

namespace App\Http\Controllers\Owners\Registration;

use App\Models\GymInfo;
use App\Models\Owner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class GymInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function create()
    {
        return view('owner.registration.gym_info.create');
        return 'gym-info';
    }

    public function store(Request $request)
    {
        // return Auth::user();
        $gym_info = new GymInfo;
        $gym_info->owner_id              = Auth::user()->id;
        $gym_info->name                  = $request->gym_name;
        $gym_info->prefecture            = $request->gym_address_prefecture;
        $gym_info->city                  = $request->gym_address_city;
        $gym_info->street                = $request->gym_address_street;
        $gym_info->building              = $request->gym_address_building;
        $gym_info->mobile_phone_number   = $request->gym_mobile_phone_number;
        $gym_info->landline_phone_number = $request->gym_landline_phone_number;
        $gym_info->closest_station       = $request->gym_closest_station;
        $gym_info->maximum_capacity      = $request->maximum_capacity;
        $gym_info->size                  = $request->gym_size;
        $gym_info->size = Auth::user()->id;
        $gym_info->save();
        return redirect()->route('owner.opening_hour_setting.crete');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
