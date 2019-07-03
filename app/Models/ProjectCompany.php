<?php
namespace App\Models;
class ProjectCompany extends BaseUuid
{
    protected $table = 'project_companies';
    
    protected $fillable = [
        'user_id', 'project_id'
    ];
    public function project()
    {
        return $this->belongsTo('App\Models\Project', 'project_id', 'id');
    }
    public function companyUser()
    {
        return $this->belongsTo('App\Models\CompanyUser', 'user_id', 'id');
    }
}
