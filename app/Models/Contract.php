<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Contract extends BaseUuid
{
    protected $table = 'contracts';

    protected $fillable = [
        'company_id', 'task_id', 'status',
    ];

    public function company()
    {
        return $this->belongsTo('App\Models\Company', 'company_id', 'id');
    }

    public function companyUser()
    {
        return $this->belongsTo('App\Models\companyUser', 'companyUser_id', 'id');
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
