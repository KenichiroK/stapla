<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GymReservation extends BaseUuid
{
    protected $table = 'gym_reservations';

    protected $fillable = [
        'gym_id',
        'reservation_date',
        'reservation_start_time',
        'reservation_end_time',
    ];

    public function gymInfo()
    {
        return $this->belongsTo('App\Models\GymInfo', 'gym_id', 'id');
    }
}
