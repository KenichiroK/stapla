<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\GymInfo;
use App\Models\GymReservation;
use Carbon\Carbon;

class ReservationController extends Controller
{
    public function index()
    {
        $gyms = GymInfo::get();
        // return $gyms;
        return view('user.reservation.index', compact('gyms'));
    }

    public function create(Request $request)
    {

        $request->validate([
            'date_of_use' => 'before:"today +14day"',
        ]);
        return $request;
        $gym = GymInfo::findOrFail($request->gym_id);

        $gym_reserved = GymReservation::where('reservation_date', Carbon::createFromTimestamp(strtotime($request->date_of_use))->format('Y-m-d'))
                            ->get();
        $gym_reservation                     = new GymReservation;
        $gym_reservation->gym_id             = $gym->id;
        $gym_reservation->reservation_date   = Carbon::createFromTimestamp(strtotime($request->date_of_use))
                                                 ->format('Y-m-d');
        $gym_reservation->save();

        $date = date('w', mktime(0, 0, 0, explode('-', $gym_reservation->reservation_date)[1], explode('-', $gym_reservation->reservation_date)[2], explode('-', $gym_reservation->reservation_date)[0]));

        return \view('user.reservation.create', \compact('gym', 'gym_reserved', 'gym_reservation', 'date'));
    }

    public function store(Request $request, $gym_reservation_id)
    {
        // return $request;
        // return $
        // $gym_reservation = GymReservation::where('id', $gym_reservation_id)->first();
        $gym_reservation = GymReservation::findOrFail($gym_reservation_id);
        // return $gym_reservation;
        $gym_reservation->reservation_start_time = $request->reservation_start_time;
        $gym_reservation->reservation_end_time   = $request->reservation_end_time;
        $gym_reservation->save();
        return redirect()->route('user.dashboard.index')->with('completed', '「'.$gym_reservation->reservation_date.'」に予約をおこないました。');
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
