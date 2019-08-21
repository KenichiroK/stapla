<?php

namespace App\Models;

class ProjectSuperior extends BaseUuid
{
    protected $table = 'project_superiors';

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
