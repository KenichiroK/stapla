<?php

namespace App\Http\Controllers\Partners;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RequestTask;

class InvoiceTaskController extends Controller
{
    public function store($invoice_id, Request $request)
    {
        for ($i = 0; $i < count($request->item_name); $i++) {
            ${"request_task" . $i} = new RequestTask;
            ${"request_task" . $i}->invoice_id = $invoice_id;
            ${"request_task" . $i}->name       = $request->item_name[$i];
            ${"request_task" . $i}->num        = $request->item_num[$i];
            ${"request_task" . $i}->unit_price = $request->item_unit_price[$i];
            ${"request_task" . $i}->total      = $request->item_total[$i];
            ${"request_task" . $i}->save();
        }
    }
}
