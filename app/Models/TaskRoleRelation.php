<?php
namespace App\Models;
class TaskRoleRelation extends BaseUuid
{
    protected $table = 'task_role_relations';
    protected $fillable = [
        'task_id', 'superior_id', 'accounting_id', 'manager_id'
    ];
    public function task()
    {
        return $this->belongsTo('App\Models\Task', 'task_id', 'id');
    }
}
