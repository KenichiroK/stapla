<?php
namespace App\Models;

class Partner extends BaseUuid
{   
    protected $table = 'partners';
    
    protected $fillable = [
        'company_id', 'partner_id', 'name', 'nickname', 'zip_code', 'prefecture', 'city', 'street', 'building', 'tel', 'age',
        'sex', 'picture', 'occupations', 'academic', 'slack', 'chatwork', 'twitter', 'facebook', 'github', 'instagram', 'careersummary', 'jobcareer', 
        'portfolio', 'introduction', 'possible', 'skill', 'feature', 'language', 'qualification', 'relatedlinks', 'attachment' 
    ];
    
    public function taskPartners()
    {
        return $this->hasMany('App\Models\TaskPartner', 'user_id', 'id');
    }

    public function projectPartners()
    {
        return $this->hasMany('App\Models\ProjectPartner', 'user_id', 'id');
    }

    public function partnerAuth()
    {
        return $this->belongsTo('App\Models\PartnerAuth', 'partner_id', 'id');
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
