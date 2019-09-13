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
            if (
                !!$request->item_name[$i] &&
                !!$request->item_num[$i] &&
                !!$request->item_unit_price[$i] &&
                !!$request->item_total[$i]
            ) {
                $model = new RequestTask;
                $model->invoice_id = $invoice_id;
                $model->name       = $request->item_name[$i];
                $model->num        = $request->item_num[$i];
                $model->unit_price = $request->item_unit_price[$i];
                $model->total      = $request->item_total[$i];
                $model->save();
                }
        }
    }
}
