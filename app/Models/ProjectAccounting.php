<?php

namespace App\Models;

class ProjectAccounting extends BaseUuid
{
    protected $table = 'project_accountings';

    protected $fillable = [
        'project_id', 'user_id'
    ];
}
