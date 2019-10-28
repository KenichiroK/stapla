<?php
namespace App\Models;

class Company extends BaseUuid
{
    protected $table = 'companies';
    protected $fillable = [
        'company_name', 'representive_name', 'zip_code', 'address_prefecture',
        'address_city', 'address_building', 'tel', 'expire', 'expire2', 
        'approval_setting', 'income_tax_setting', 'remind_setting',
        'purchase_order_setting', 'confidential_setting', 'account_setting'
    ];
    public function companyUsers()
    {
        return $this->hasMany('App\Models\CompanyUser', 'company_id', 'id');
    }
    
    public function projects()
    {
        return $this->hasMany('App\Models\Project', 'project_id', 'id');
    }

    public function partners()
    {
        return $this->hasMany('App\Models\Partner', 'company_id', 'id');
    }

    public function purchaseOrders()
    {
        return $this->hasMany('App\Models\PurchaseOrder', 'company_id', 'id');
    }

    public function invoices()
    {
        return $this->hasMany('App\Models\Invoice', 'company_id', 'id');
    }
}
