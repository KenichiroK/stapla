<?php
namespace App\Models;
class TaskCompany extends BaseUuid
{
    protected $table = 'task_company_pics';
    
    protected $fillable = [
        'user_id', 'task_id'
    ];
    public function companyUser()
    {
        return $this->belongsTo('App\Models\CompanyUser', 'user_id', 'id');
    }
    public function task()
    {
        return $this->belongsTo('App\Models\Task', 'task_id', 'id');
    }
}
