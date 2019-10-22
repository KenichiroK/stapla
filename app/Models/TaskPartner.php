<?php
namespace App\Models;
class TaskPartner extends BaseUuid
{
    protected $table = 'task_partners';
    
    protected $fillable = [
        'partner_id', 'task_id'
    ];
    public function task()
    {
        return $this->belongsTo('App\Models\Task', 'task_id', 'id');
    }
    public function partner()
    {
        return $this->belongsTo('App\Models\Partner', 'partner_id', 'id');
    }
}
