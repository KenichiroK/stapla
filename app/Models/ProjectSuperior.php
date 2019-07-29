<?php

namespace App\Models;

class ProjectSuperior extends BaseUuid
{
    protected $table = 'project_superiors';

    protected $fillable = [
        'project_id', 'user_id'
    ];
}
