<?php

namespace App\Http\Controllers\Companies\Document;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Companies\CreatePurchaseOrderRequest;
use App\Models\Company;
use App\Models\CompanyUser;
use App\Models\Partner;
use App\Models\Task;
use App\Models\PurchaseOrder;
use App\Models\Invoice;
use App\Models\TaskPartner;

class PurchaseOrderController extends Controller
{
    public function show($purchaseOrder_id)
    {
        $purchaseOrder = PurchaseOrder::findOrFail($purchaseOrder_id);
        $task = Task::findOrFail($purchaseOrder->task_id);
        $company_user = Auth::user();
        $company_user_ids = array();
        if ($task->companyUser) {
            array_push($company_user_ids, $task->companyUser->id);
        }

        return view('company/document/purchaseOrder/show', compact('purchaseOrder', 'company_user', 'company_user_ids', 'task'));
    }
}
