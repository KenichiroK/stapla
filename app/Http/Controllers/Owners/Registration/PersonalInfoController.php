<?php

namespace App\Http\Controllers\Owners\Registration;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class PersonalInfoController extends Controller
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
        return view('owner.registration.personal_info.create');
    }

  
    public function store(Request $request)
    {
        $owner = Auth::user();
        $owner->birthday            = $request->owner_birthday;
        $owner->prefecture          = $request->owner_address_prefecture;
        $owner->city                = $request->owner_address_city;
        $owner->street              = $request->owner_address_street;
        $owner->building            = $request->owner_address_building;
        $owner->mobile_phone_number = $request->owner_mobile_phone_number;
        $owner->save();
        // return $owner;
        return redirect()->route('owner.gymInfo.crete');
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
