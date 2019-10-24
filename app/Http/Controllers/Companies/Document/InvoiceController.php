<?php

namespace App\Http\Controllers\Companies\Document;

use Illuminate\Http\Request;
use App\Http\Requests\Partners\CreateInvoiceRequest;
use App\Http\Controllers\Controller;
use App\Models\Partner;
use App\Models\Task;
use App\Models\Invoice;
use App\Models\CompanyUser;
use App\Models\Company;
use App\Models\RequestTask;
use App\Models\RequestExpence;
use Illuminate\Support\Facades\Auth;


class InvoiceController extends Controller
{
    public function show($id)
    {
        $company_user = Auth::user();
        $invoice = Invoice::findOrFail($id);
        $task = Task::findOrFail($invoice->task_id);
        $total_sum = 0;
        $partner = Partner::findOrFail($invoice->partner_id);

        $company_user_ids = array();
        if ($task->companyUser) {
            array_push($company_user_ids, $task->companyUser->id);
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

        return view('/company/document/invoice/show', compact('company_user', 'partner', 'invoice', 'task', 'total_sum', 'company_user_ids'));
    }
}
