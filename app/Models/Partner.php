<?php
namespace App\Models;

use App\Notifications\PartnerVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\PartnerPasswordResetNotification;

class Partner extends Authenticatable
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

    protected $table = 'partners';
    
    protected $fillable = [
        'company_id', 'email', 'password', 'name', 'nickname', 'zip_code', 'prefecture', 'city', 'street', 'building', 'tel', 'age',
        'sex', 'picture', 'occupations', 'academic', 'slack', 'chatwork', 'twitter', 'facebook', 'github', 'instagram', 'careersummary', 'jobcareer', 
        'portfolio', 'introduction', 'possible', 'skill', 'feature', 'language', 'qualification', 'relatedlinks', 'attachment' 
    ];

    protected $hidden = [
        'password', 'remember_token'
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PartnerPasswordResetNotification($token));
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new PartnerVerifyEmail);
    }
    
    public function taskPartners()
    {
        return $this->hasMany('App\Models\TaskPartner', 'partner_id', 'id');
    }

    public function projectPartners()
    {
        return $this->hasMany('App\Models\ProjectPartner', 'user_id', 'id');
    }

    public function company()
    {
        return $this->belongsTo('App\Models\Company', 'company_id', 'id');
    }

    public function purchaseOrders()
    {
        return $this->hasMany('App\Models\PurchaseOrder', 'partner_id', 'id');
    }

    public function contracts()
    {
        return $this->hasMany('App\Models\Contract', 'partner_id', 'id');
    }

    public function ndas()
    {
        return $this->hasMany('App\Models\Nda', 'partner_id', 'id');
    }

    public function invoices()
    {
        return $this->hasMany('App\Models\Invoice', 'partner_id', 'id');
    }

    public function partnerInvoice()
    {
        return $this->hasOne('App\Models\PartnerInvoice', 'partner_id', 'id');
    }

    public function partnerAccountSetting()
    {
        return $this->hasOne('App\Models\PartnerAccountSetting', 'partner_id', 'id');
    }

    public function taskPartner()
    {
        return $this->hasOne('App\Models\Task', 'partner_id', 'id');
    }
}
