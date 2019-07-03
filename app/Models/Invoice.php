<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Invoice extends BaseUuid
{
    protected $table = 'invoices';
    protected $fillable = [
        'company_id', 'task_id', 'status', 'expenses'
    ];
    public function company()
    {
        return $this->belongsTo('App\Models\Company', 'company_id', 'id');
    }

    public function partner()
    {
        return $this->belongsTo('App\Models\Partner', 'partners_id', 'id');
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
