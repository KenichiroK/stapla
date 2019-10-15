<?php

namespace App\Models;

use App\Notifications\UserVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class FirstCompanyUser extends Authenticatable implements MustVerifyEmail
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
    protected $table = 'first_company_users';
    
    protected $fillable = [
        'email', 'password'
     ];
     protected $hidden = [
         'password', 'remember_token'
     ];

    public function sendEmailVerificationNotification()
    {
        $this->notify(new UserVerifyEmail);
    }
}
