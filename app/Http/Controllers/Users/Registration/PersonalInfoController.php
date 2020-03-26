<?php

namespace App\Http\Controllers\Users\Registration;


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
        return view('user.registration.personalInfo.create');
    }

    public function store(Request $request)
    {
        $user =  Auth::user();
        $user->birthday            = $request->user_birthday;
        $user->prefecture          = $request->user_address_prefecture;
        $user->city                = $request->user_address_city;
        $user->street              = $request->user_address_street;
        $user->building            = $request->user_address_building;
        $user->mobile_phone_number = $request->user_mobile_phone_number;
        $user->save();
        return redirect()->route('user.dashboard.index');
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
