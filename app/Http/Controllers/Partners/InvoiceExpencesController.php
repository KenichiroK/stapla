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
            if (
                !!$request->expences_name[$i] &&
                !!$request->expences_num[$i] &&
                !!$request->expences_unit_price[$i] &&
                !!$request->expences_total[$i]
            ) {
                $model = new RequestExpence;
                $model->invoice_id = $invoice_id;
                $model->name       = $request->expences_name[$i];
                $model->num        = $request->expences_num[$i];
                $model->unit_price = $request->expences_unit_price[$i];
                $model->total      = $request->expences_total[$i];
                $model->save();
                \Log::info('請求書詳細(経費) 登録', ['request_expence_id' => $model->id, 'invoice_id' => $invoice_id]);
            }
            
        }
    }
}
