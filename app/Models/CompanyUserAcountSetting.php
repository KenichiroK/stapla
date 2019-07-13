<?php

namespace App\Models;

class CompanyUserAcountSetting extends BaseUuid
{
    protected $table = 'company_user_acount_settings';

    protected $fillable= [
        'user_id', 'email_notification', 'daily_mail', 'slack'
    ];

    public function companyUser()
    {
        return  $this->belongsTo('App\Models\CompanyUser', 'user_id', 'id');
    }
}
