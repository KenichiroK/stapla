<?php

namespace App\Http\Controllers\Owners;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\GymInfo;

class Taskcontroller extends Controller
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
        return 'testtest';
        // return 'test show';
        $gym = GymInfo::findOrFail($gym_id);
        return $gym; 
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
