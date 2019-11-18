<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliverItem extends BaseUuid
{
    protected $table = 'deliver_items';

    protected $fiilable = [
        'deliver_id', 'file'
    ];

    public function deliver()
    {
        return $this->belongsTo('App\Models\Deliver', 'deliver_id', 'id');
    }
}
