<?php
namespace App\Models;

use App\Notifications\UserVerifyEmailNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class CompanyUser extends Authenticatable
{
    use Notifiable;
    public $incrementing = false;
    public static function boot()
    {
        parent::boot();
        self::creating(function($model){
            $model->id = (string)\Illuminate\Support\Str::uuid();
        });
    }
    protected $table = 'company_users';
    
    protected $fillable = [
        'email', 'password', 'company_id', 'name', 'department', 'occupation', 'self_introduction', 'picture'
    ];

    protected $hidden = [
        'password', 'remember_token'
    ];

    // 登録済みかどうかの判定
    public function scopeIsRegistered()
    {
        return isset($companyUser);
    }

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
