<?php
namespace App\Models;
class Partner extends BaseUuid
{   
    protected $table = 'partners';
    
    protected $fillable = [
        'company_id', 'partner_id', 'name', 'zip_code', 'address', 'tel', 'age',
        'sex', 'picture', 'occupations', 'academic', 'slack', 'chatwork', 'twitter', 'facebook', 'careersummary', 'jobcareer', 
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
}
