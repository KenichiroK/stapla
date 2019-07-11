<?php

namespace App\Models;


class RequestTask extends BaseUuid
{
    protected $table = 'request_tasks';
    
    protected $fillable = [
        'invoice_id', 'name', 'num', 'unit_price', 'total',
    ];

    public function invoice()
    {
        return $this->belongsTo('App\Models\Invoice', 'invoice_id', 'id');
    }
}
