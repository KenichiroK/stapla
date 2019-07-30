<?php

namespace App\Models;

class ProjectAccounting extends BaseUuid
{
    protected $table = 'project_accountings';

    protected $fillable = [
        'project_id', 'user_id'
    ];

    public function project()
    {
        return $this->belongsTo('App\Models\Project', 'project_id', 'id');
    }

    public function companyUser()
    {
        return $this->belongsTo('App\Models\companyUser', 'user_id', 'id');
    }
}
