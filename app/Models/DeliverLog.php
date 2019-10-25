<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliverLog extends BaseUuid
{
    protected $table = 'deliver_logs';

    protected $fillable = [
        'task_id', 'partner_id'
    ];
}
