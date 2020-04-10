<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GymOpeningHour extends BaseUuid
{
    protected $table = 'gym_opening_hours';

    protected $fillable = [
        'gym_id',
        'opening_hour',
    ];
}
