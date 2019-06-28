<?php
namespace App\Models;
class Task extends BaseUuid
{
    protected $table = 'tasks';
    
    protected $fillable = [
        'project_id', 'company_id', 'name', 'content', 'started_at', 'ended_at','status', 'purchaseorder', 'invoice','budget','price', 'comment', 'inspection_date', 'fee_format', 'delivery_format', 'payment_terms', 'rating'
    ];
    public function project(){
        return $this->belongsTo('App\Models\Project', 'project_id', 'id');
    }
    public function taskCompany()
    {
        return $this->hasMany('App\Models\TaskCompany', 'task_id', 'id');
    }
    public function taskPartner()
    {
        return $this->hasMany('App\Models\TaskPartner', 'task_id', 'id');
    }
    public function taskRoleRelation()
    {
        return $this->hasOne('App\Models\TaskRoleRelation', 'task_id', 'id');
    }
    public function purchaseOrder()
    {
        return $this->hasOne('App\Models\PurchaseOrder', 'task_id', 'id');
    }
    public function contract()
    {
        return $this->hasOne('App\Models\Contract', 'task_id', 'id');
    }
    public function confidentialityAgreement()
    {
        return $this->hasOne('App\Models\ConfidentialityAgreement', 'task_id', 'id');
    }
    public function invoice()
    {
        return $this->hasOne('App\Models\Invoice', 'task_id', 'id');
    }

}
