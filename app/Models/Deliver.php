<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deliver extends Model
{
    protected $table = 'delivers';

    protected $fillable = [
        'task_id', 'deliver_comment', 'deliver_file'
    ];

    public function task()
    {
        return $this->belongsTo('App\Models\Task', 'task_id', 'id');
    }
}
