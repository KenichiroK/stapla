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
        $partner = Auth::user();
        $company_id = $partner->company_id;
        $company = Company::findOrFail($company_id);
        $companyUsers = CompanyUser::where('company_id', $company_id)->get();
        return view('/partner/document/invoice/create', compact('partner', 'companyUsers', 'company', 'task'));
    }

    public function store(CreateInvoiceRequest $request)
    {
        $partner = Auth::user();
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

        $invoiceTaskController = new InvoiceTaskController;
        app()->call([$invoiceTaskController, 'store'], ['invoice_id' => $invoice->id]);

        $invoiceExpencesController = new InvoiceExpencesController;
        app()->call([$invoiceExpencesController, 'store'], ['invoice_id' => $invoice->id]);
            
        return redirect()->route('partner.document.invoice.show', ['id' => $invoice->id]);
    }

    public function show($id)
    {
        $partner = Auth::user();
        $invoice = Invoice::findOrFail($id);
        $task = Task::findOrFail($invoice->task_id);
        $companyUsers = CompanyUser::where('company_id', $partner->company_id)->get();
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

        return view('/partner/document/invoice/show', compact('partner', 'companyUsers', 'invoice', 'task', 'total_sum'));
    }
}
