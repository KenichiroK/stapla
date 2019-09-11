<?php

namespace App\Http\Controllers\Partners;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RequestExpence;

class InvoiceExpencesController extends Controller
{
    public function store($invoice_id, Request $request)
    {
        for ($i = 0; $i < count($request->expences_name); $i++) {
            ${"request_expences" . $i} = new RequestExpence;
            ${"request_expences" . $i}->invoice_id = $invoice_id;
            ${"request_expences" . $i}->name       = $request->expences_name[$i];
            ${"request_expences" . $i}->num        = $request->expences_num[$i];
            ${"request_expences" . $i}->unit_price = $request->expences_unit_price[$i];
            ${"request_expences" . $i}->total      = $request->expences_total[$i];
            ${"request_expences" . $i}->save();
        }
    }
}
