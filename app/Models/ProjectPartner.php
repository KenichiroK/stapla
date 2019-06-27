<?php
namespace App\Models;
class ProjectPartner extends BaseUuid
{
    protected $table = 'project_partner_pics';
    
    protected $fillable = [
        'user_id', 'project_id'
    ];
    public function project()
    {
        return $this->belongsTo('App\Models\Project', 'project_id', 'id');
    }
    public function partner()
    {
        return $this->belongsTo('App\Models\Partner', 'user_id', 'id');
    }
}
