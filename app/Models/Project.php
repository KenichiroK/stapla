<?php
namespace App\Models;
class Project extends BaseUuid
{
    protected $table = 'projects';
    
    protected $fillable = [
        'company_id', 'name', 'detail', 'started_at', 'ended_at', 'status', 'budget' ,'price'
    ];
    public function company()
    {
        return $this->belongsTo('App\Models\Company', 'company_id', 'id');
    }
    public function tasks()
    {
        return $this->hasMany('App\Models\Task', 'project_id', 'id');
    }
    public function projectRoleRelation()
    {
        return $this->hasOne('App\Models\ProjectRoleRelation', 'project_id', 'id');
    }
    public function projectPartners()
    {
        return $this->hasMany('App\Models\ProjectPartner', 'project_id', 'id');
    }
    public function projectCompanies()
    {
        return $this->hasMany('App\Models\ProjectCompany', 'project_id', 'id');
    }

    protected $dates = [
        'started_at',
        'ended_at',
    ];
}
