<?php

namespace App\Models;

class PartnerAccountSetting extends BaseUuid
{
    protected $table = 'partner_account_settings';

    protected $fillable= [
        'partner_id', 'email_notification', 'daily_mail', 'slack'
    ];

    public function partner()
    {
        return  $this->belongsTo('App\Models\Partner', 'partner_id', 'id');
    }
}
