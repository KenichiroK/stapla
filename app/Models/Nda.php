<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nda extends BaseUuid
{
    protected $table = 'ndas';

    protected $fillable = [
        'company_id', 'companyUser_id', 'task_id', 'status', 'company_name', 'partner_name',
    ];

    public function company()
    {
        return $this->belongsTo('App\Models\Company', 'company_id', 'id');
    }

    public function partner()
    {
        return $this->belongsTo('App\Models\Partner', 'partner_id', 'id');
    }

    public function task()
    {
        return $this->belongsTo('App\Models\Task', 'task_id', 'id');
    }

    public function companyUserAccountSetting()
    {
        return $this->hasOne('App\Models\CompanyUserAcountSetting', 'company_user_id', 'id');
    }
}
