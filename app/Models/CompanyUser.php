<?php
namespace App\Models;

class CompanyUser extends BaseUuid
{
    protected $table = 'company_users';
    
    protected $fillable = [
        'auth_id', 'company_id', 'name', 'department', 'occupation', 'self_introduction', 'picture'
    ];

    public function companyUserAuth()
    {
        return $this->belongsTo('App\Models\CompanyUserAuth', 'auth_id', 'id');
    }

    public function company()
    {
        return $this->belongsTo('App\Models\Company', 'company_id', 'id');
    }

    public function userRoleRelation()
    {
        return $this->hasOne('App\Models\UserRoleRelation', 'user_id', 'id');
    }

    public function projectCompanies()
    {
        return $this->hasMany('App\Models\ProjectCompany', 'user_id', 'id');
    }

    public function taskCompanies()
    {
        return $this->hasMany('App\Models\TaskCompany', 'user_id', 'id');
    }

    public function companyUserAccountSetting()
    {
        return $this->hasOne('App\Models\CompanyUserAcountSetting', 'user_id', 'id');
    }

    public function ProjectSuperiors()
    {
        return $this->hasMany('App\Models\ProjectSuperior', 'user_id', 'id');
    }

    public function ProjectAccountings()
    {
        return $this->hasMany('App\Models\ProjectAccounting', 'user_id', 'id');
    }
    
    public function taskSuperior()
    {
        return $this->hasOne('App\Models\Task', 'superior_id', 'id');
    }

    public function taskAccounting()
    {
        return $this->hasOne('App\Models\Task', 'accounting_id', 'id');
    }

    public function purchaseOrders()
    {
        return $this->hasMany('App\Models\PurchaseOrder', 'companyUser_id', 'id');
    }

    public function contracts()
    {
        return $this->hasMany('App\Models\Contract', 'companyUser_id', 'id');
    }

    public function ndas()
    {
        return $this->hasMany('App\Models\Nda', 'companyUser_id', 'id');
    }

    public function invoices()
    {
        return $this->hasMany('App\Models\Invoice', 'companyUser_id', 'id');
    }
}
