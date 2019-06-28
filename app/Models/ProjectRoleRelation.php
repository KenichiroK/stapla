<?php
namespace App\Models;
class ProjectRoleRelation extends BaseUuid
{
    protected $table = 'project_role_relations';
    
    protected $fillable = [
        'project_id', 'superior_id', 'accounting_id', 'manager_id'
    ];
    public function project()
    {
        return $this->belongsTo('App\Models\Project', 'project_id', 'id');
    }
}
