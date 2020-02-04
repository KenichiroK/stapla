<?php
namespace App\Models;

class OutsourceContract extends BaseUuid
{
    protected $table = 'outsource_contracts';

    protected $guarded = ['id'];

    public function company()
    {
        return $this->belongsTo('App\Models\Company', 'company_id', 'id');
    }

    public function partner()
    {
        return $this->belongsTo('App\Models\Partner', 'partner_id', 'id');
    }
}
