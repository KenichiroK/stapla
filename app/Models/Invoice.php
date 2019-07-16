<?php
namespace App\Models;

class Invoice extends BaseUuid
{
    protected $table = 'invoices';

    protected $fillable = [
        'company_id', 'companyUser_id', 'partner_id', 'project_name', 'requested_at', 'deadline_at', 'tax', 'status'
    ];

    public function company()
    {
        return $this->belongsTo('App\Models\Company', 'company_id', 'id');
    }

    public function companyUser()
    {
        return $this->belongsTo('App\Models\CompanyUser', 'companyUser_id', 'id');
    }

    public function partner()
    {
        return $this->belongsTo('App\Models\Partner', 'partner_id', 'id');
    }

    public function task()
    {
        return $this->belongsTo('App\Models\Task', 'task_id', 'id');
    }

    public function requestTasks()
    {
        return $this->hasMany('App\Models\RequestTask', 'invoice_id', 'id');
    }

    public function requestExpences()
    {
        return $this->hasMany('App\Models\requestExpence', 'invoice_id', 'id');
    }
}
