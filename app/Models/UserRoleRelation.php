<?php
namespace App\Models;
class UserRoleRelation extends BaseUuid
{
    protected $table = 'user_role_relations';
    
    protected $fillable = [
        'user_id', 'superior_id', 'accounting_id', 'manager_id'
    ];
    public function companyUser()
    {
        return $this->belongsTo('App\Models\CompanyUser', 'user_id', 'id');
    }
}
