<?php

namespace App\Http\Controllers\Partners;

use Illuminate\Http\Request;
use App\Http\Requests\Partners\CreateInvoiceRequest;
use App\Http\Controllers\Controller;
use App\Models\Partner;
use App\Models\Invoice;
use App\Models\CompanyUser;
use App\Models\Company;
use App\Models\RequestTask;
use App\Models\RequestExpence;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $auth_id = Auth::user()->id;
        $partner = Partner::where('partner_id', $auth_id)->get()->first();
        $company_id = $partner->company_id;
        $company = Company::findOrFail($company_id);
        $companyUsers = CompanyUser::where('company_id', $company_id)->get();
        return view('/partner/document/invoice/create', compact('partner', 'companyUsers', 'company'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateInvoiceRequest $request)
    {
        $auth_id = Auth::user()->id;
        $partner = Partner::where('partner_id', $auth_id)->get()->first();
        $company_id = $partner->company_id;

        $invoice = new Invoice;
        $invoice->company_id     = $company_id;
        $invoice->companyUser_id = $request->companyUser_id;
        $invoice->partner_id     = $partner->id;
        $invoice->project_name   = $request->project_name;
        $invoice->requested_at   = $request->requested_at;
        $invoice->deadline_at    = $request->deadline_at;
        $invoice->tax            = $request->tax;
        $invoice->status         = 0;
        $invoice->save();

        if ($request->task_name) {
            $request_task = new RequestTask;
            $request_task->invoice_id = $invoice->id;
            $request_task->name       = $request->task_name;
            $request_task->num        = $request->task_num;
            $request_task->unit_price = $request->task_unit_price;
            $request_task->total      = $request->task_total;
            $request_task->save();
        }
        
        if ($request->expences_name) {
            $request_expences = new RequestExpence;
            $request_expences->invoice_id = $invoice->id;
            $request_expences->name       = $request->expences_name;
            $request_expences->num        = $request->expences_num;
            $request_expences->unit_price = $request->expences_unit_price;
            $request_expences->total      = $request->expences_total;
            $request_expences->save();
        }
        
        return redirect()->route('partner.invoice.show', ['id' => $invoice->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $auth_id = Auth::user()->id;
        $partner = Partner::where('partner_id', $auth_id)->get()->first();
        $invoice = Invoice::findOrFail($id);

        if ($partner->id !== $invoice->partner_id) {
            return 'no data';
        }

        return view('/partner/document/invoice/show', compact('partner', 'invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
