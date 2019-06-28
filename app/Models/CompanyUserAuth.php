<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class CompanyUserAuth extends Authenticatable
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
    protected $table = 'company_user_auths';
    
    protected $fillable = [
       'email', 'password'
    ];
    protected $hidden = [
        'password', 'remember_token'
    ];
    
    public function companyUser()
    {
        return $this->hasOne('App\Models\CompanyUser', 'auth_id', 'id');
    }
}
