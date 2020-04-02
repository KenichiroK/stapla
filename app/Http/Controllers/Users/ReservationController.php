<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReservationController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        return view('user.reservation.create');
    }

    public function store(Request $request)
    {
        // return 'te st1';
        // return redirect()->route('user.dashboard.index')->with('completed', '「'.$task->name.'」を作成しました。');
        return redirect()->route('user.dashboard.index')->with('completed', 'ジムを予約をしました。');
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
