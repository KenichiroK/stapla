<?php

namespace App\Http\Controllers\Owners;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\GymInfo;

class GymController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($gym_id)
    {
        $gym = GymInfo::findOrFail($gym_id);
        // return $gym;
        return view('owner.gym.show', \compact('gym'));
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
