<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deliver extends BaseUuid
{
    protected $table = 'delivers';

    protected $fillable = [
        'task_id', 'file'
    ];

    public function task()
    {
        return $this->belongsTo('App\Models\Task', 'task_id', 'id');
    }

    public function deliverItems()
    {
        return $this->hasMany('App\Models\DeliverItem', 'deliver_id', 'id');
    }
}