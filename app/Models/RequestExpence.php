<?php

namespace App\Models;

class RequestExpence extends BaseUuid
{
    protected $table = 'request_expences';
    
    protected $fillable = [
        'invoice_id', 'name', 'num', 'unit_price', 'total',
    ];

    public function invoice(){
        return $this->belongsTo('App\Models\Invoice', 'invoice_id', 'id');
    }
}
