<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GymInfo extends BaseUuid
{
    protected $table = 'gym_infos';

    protected $fillable = [
        'name',
        'birthday',
        'prefecture',
        'city',
        'street',
        'building',
        'mobile_phone_number',
        'landline_phone_number',
        'closest_station',
        'maximum_capacity',
        'size',
    ];

    public function gymReservations()
    {
        return $this->hasMany('App\Models\GymReservation', 'gym_id', 'id');
    }
}
