<?php

namespace App\Http\Controllers\Partners;

use Illuminate\Http\Request;
use App\Http\Requests\Partners\CreateInvoiceRequest;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Partners\InvoiceTaskController;
use App\Http\Controllers\Partners\InvoiceExpencesController;
use App\Models\Partner;
use App\Models\Task;
use App\Models\Invoice;
use App\Models\CompanyUser;
use App\Models\Company;
use App\Models\PartnerInvoice;

use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    public function create($id)
    {
        $task = Task::findOrFail($id);
        $auth_id = Auth::user()->id;
        $partner = Partner::where('partner_id', $auth_id)->get()->first();
        $company_id = $partner->company_id;
        $company = Company::findOrFail($company_id);
        $companyUsers = CompanyUser::where('company_id', $company_id)->get();
        return view('/partner/document/invoice/create', compact('partner', 'companyUsers', 'company', 'task'));
    }

    public function store(CreateInvoiceRequest $request)
    {
        $auth_id = Auth::user()->id;
        $partner = Partner::where('partner_id', $auth_id)->get()->first();
        $partner_invoice = PartnerInvoice::where('partner_id', $partner->id)->get()->first();
        if (!$partner_invoice) {
            $completed = '';
            return redirect()->route('partner.setting.invoice.create')
                ->with('not_register_invoice', '請求情報が未登録のため、請求書の作成に失敗しました。請求情報を登録して、再度請求書を作成してください。');
        }

        $company_id = $partner->company_id;
        $invoice = new Invoice;
        $invoice->company_id     = $company_id;
        $invoice->companyUser_id = $request->company_user_id;
        $invoice->task_id        = $request->task_id;
        $invoice->partner_id     = $partner->id;
        $invoice->project_name   = $request->title;
        $invoice->requested_at   = $request->requested_at;
        $invoice->deadline_at    = $request->deadline_at;
        $invoice->tax            = $request->tax;
        $invoice->status         = 0;
        $invoice->save();

        if (!!$request->item_name[0] &&
            !!$request->item_num[0] &&
            !!$request->item_unit_price[0] &&
            !!$request->item_total[0]
        ) {
            $controller = new InvoiceTaskController;
            app()->call([$controller, 'store'], ['invoice_id' => $invoice->id]);
        }

        if (!!$request->expences_name[0] &&
            !!$request->expences_num[0] &&
            !!$request->expences_unit_price[0] &&
            !!$request->expences_total[0]
        ) {
            $controller = new InvoiceExpencesController;
            app()->call([$controller, 'store'], ['invoice_id' => $invoice->id]);
        }
            
        return redirect()->route('partner.invoice.show', ['id' => $invoice->id]);
    }

    public function show($id)
    {
        $auth_id = Auth::user()->id;
        $partner = Partner::where('partner_id', $auth_id)->get()->first();
        $invoice = Invoice::findOrFail($id);
        $task = Task::findOrFail($invoice->task_id);
        $total_sum = 0;
        if ($partner->id !== $invoice->partner_id) {
            return 'no data';
        }
        
        if ($invoice->requestTasks->count() > 0) {
            foreach($invoice->requestTasks as $requestTask) {
                $total_sum += $requestTask->total;
            }
        }
        if ($invoice->requestExpences->count() > 0) {
            foreach($invoice->requestExpences as $requestExpence) {
                $total_sum += $requestExpence->total;
            }
        }

        return view('/partner/document/invoice/show', compact('partner', 'invoice', 'task', 'total_sum'));
    }
}
