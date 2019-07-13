<?php

namespace App\Models;

class PartnerInvoice extends BaseUuid
{
    protected $table = 'partner_invoices';

    protected $fillable = [
        'partner_id', 'financial_institution', 'branch', 'deposit_type', 
        'account_number', 'account_holder', 'mark'
    ];

    public function partner()
    {
        return $this->belongsTo('App\Models\Partner', 'partner_id', 'id');
    }
}
