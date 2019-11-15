<?php

namespace App\Http\Controllers\Partners;

use Illuminate\Http\Request;
// use Exception;
// use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
    public function create(Request $request, $task_id)
    {
        // タスクステータスのアップデート
        $task = Task::findOrFail($task_id)
                            ->update(['status' => config('const.INVOICE_DRAFT_CREATE')]);

        $task = Task::findOrFail($task_id);
        $partner = Auth::user();
        $company_id = $partner->company_id;
        $company = Company::findOrFail($company_id);
        $companyUsers = CompanyUser::where('company_id', $company_id)->get();
        $partner_invoice = PartnerInvoice::where('partner_id', $partner->id)->first();
        $task_count = "";
        $expences_count = "";

        if ($request->session()->has('_old_input')) {
            $old_input = $request->session()->get('_old_input');
            $task_count = count($old_input['item_name']);
            $expences_count = count($old_input['expences_name']);
        }
        return view('/partner/document/invoice/create', compact('companyUsers', 'company', 'task', 'partner_invoice', 'task_count', 'expences_count'));
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
        $invoice->company_id      = $company_id;
        if(isset($request->company_user_id)){
            $invoice->companyUser_id = $request->company_user_id;
        }
        if(isset($request->billing_to_text)){
            $invoice->billing_to_text = $request->billing_to_text;
        }
        $invoice->billing_to_text = $request->billing_to_text;
        $invoice->task_id         = $request->task_id;
        $invoice->partner_id      = $partner->id;
        $invoice->project_name    = $request->title;
        $invoice->requested_at    = $request->requested_at;
        $invoice->deadline_at     = $request->deadline_at;
        $invoice->tax             = 0;
        $invoice->status          = 0;
        $invoice->save();
        \Log::info('請求書新規登録', ['user_id(partner)' => $partner->id, 'task_id' => $invoice->task_id, 'status' => $invoice->status]);

        $invoiceTaskController = new InvoiceTaskController;
        app()->call([$invoiceTaskController, 'store'], ['invoice_id' => $invoice->id]);

        $invoiceExpencesController = new InvoiceExpencesController;
        app()->call([$invoiceExpencesController, 'store'], ['invoice_id' => $invoice->id]);
            
        return redirect()->route('partner.document.invoice.show', ['id' => $invoice->id]);
    }

    public function show($id)
    {
        $partner = Auth::user();
        $companyUsers = CompanyUser::where('company_id', $partner->company_id)->get();

        $invoice = Invoice::find($id);
        if (is_null($invoice)) {
            abort(404);
        }

        // try {
        //     Invoice::findOrFail($id);
        //     throw new ModelNotFoundException("請求書が存在しません");
        // } catch (ModelNotFoundException $e) {
        //     return redirect('fail');
        //     return $e->getMessage();
        // }
        
        // $invoice = Invoice::findOrFail($id);
        $task = Task::findOrFail($invoice->task_id);
        $total_sum = 0;
        $total_sum_notax = 0;
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

        if ($invoice->requestTasks->count() > 0) {
            foreach($invoice->requestTasks as $requestTask) {
                $total_sum_notax += $requestTask->num * $requestTask->unit_price;
            }
        }
        if ($invoice->requestExpences->count() > 0) {
            foreach($invoice->requestExpences as $requestExpence) {
                $total_sum_notax += $requestExpence->num * $requestExpence->unit_price;
            }
        }
        
        return view('/partner/document/invoice/show', compact('companyUsers', 'invoice', 'task', 'total_sum', 'total_sum_notax'));
    }
}
