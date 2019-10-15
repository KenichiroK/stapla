<?php

namespace App\Models;

use App\Notifications\PartnerVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class PartnerAuth extends Authenticatable
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
    protected $table = 'partner_auths';
    
    protected $fillable = [
        'company_id', 'email'
    ];
    protected $hidden = [
        'remember_token'
    ];

    public function sendEmailVerificationNotification()
    {
        $this->notify(new PartnerVerifyEmail);
    }
}
