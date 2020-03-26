<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GymClosingHour extends BaseUuid
{
    protected $table = 'gym_closing_hours';

    protected $fillable = [
        'gym_id',
        'closing_hour',
    ];
}
