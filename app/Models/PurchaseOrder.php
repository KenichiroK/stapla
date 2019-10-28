<?php
namespace App\Models;

class PurchaseOrder extends BaseUuid
{
    protected $table = 'purchase_orders';

    protected $fillable = [
        'company_id', 'companyUser_id', 'partner_id', 'task_id', 'status', 'ordered_at', 
        'company_name', 'company_tel', 'company_zip_code', 'company_prefecture',
        'company_city', 'company_building', 'companyUser_name', 'partner_name',
        'task_name', 'task_delivery_format', 'task_ended_at', 'task_price', 'task_tax',
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

    public function companyUserAccountSetting()
    {
        return $this->hasOne('App\Models\CompanyUserAcountSetting', 'companyUser_id', 'id');
    }
}
