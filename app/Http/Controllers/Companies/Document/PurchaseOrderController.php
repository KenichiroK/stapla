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
    public function create($id)
    {
        $auth = Auth::user();
        $task = Task::findOrFail($id);
        $company_user = CompanyUser::where('auth_id', $auth->id)->first();

        $companyUsers = CompanyUser::where('company_id', $company_user->company_id)->get();

        return view('/company/document/purchaseOrder/create', compact('company_user', 'companyUsers', 'task'));
    }

    public function store(CreatePurchaseOrderRequest $request)
    {
        // return $request;

        $auth = Auth::user();
        $companyUser = CompanyUser::where('auth_id', $auth->id)->first();
        $company = Company::findOrFail($companyUser->company_id);
        $purchaseOrder = new PurchaseOrder;
        $purchaseOrder->company_id = $company->id;
        $purchaseOrder->companyUser_id       = $request->companyUser_id;
        $purchaseOrder->partner_id           = $request->partner_id;
        $purchaseOrder->task_id              = $request->task_id;
        $purchaseOrder->status               = 0;
        $purchaseOrder->ordered_at           = date("Y-m-d");;
        $purchaseOrder->company_name         = $company->company_name;
        $purchaseOrder->company_tel          = $company->tel;
        $purchaseOrder->company_zip_code     = $company->zip_code;
        $purchaseOrder->company_prefecture   = $company->address_prefecture;
        $purchaseOrder->company_city         = $company->address_city;
        $purchaseOrder->company_building     = $company->address_building;
        $purchaseOrder->companyUser_name     = CompanyUser::findOrFail($request->companyUser_id)->name;
        $purchaseOrder->partner_name         = Partner::findOrFail($request->partner_id)->name;
        $purchaseOrder->task_delivery_format = $request->task_delivery_format;
        $task = Task::findOrFail($request->task_id);
        // return $task;
        $purchaseOrder->task_name            = $task->name;
        $purchaseOrder->task_ended_at        = $task->ended_at;
        $purchaseOrder->task_price           = $task->price;
        $purchaseOrder->task_tax             = $task->tax;
        $purchaseOrder->save();
        // return $request;


        return redirect()->route('company.document.purchaseOrder.show', ['purchaseOrder_id' => $purchaseOrder->id]);
    }

    public function show($purchaseOrder_id)
    {
        $purchaseOrder = PurchaseOrder::findOrFail($purchaseOrder_id);
        $task = Task::findOrFail($purchaseOrder->task_id);
        $auth = Auth::user();
        $company_user = CompanyUser::where('auth_id', $auth->id)->first();
        $company_user_ids = array();
        if ($task->taskCompanies) {
            foreach($task->taskCompanies as $companyUser) {
                array_push($company_user_ids, $companyUser->companyUser->id);
            }
        }

        return view('company/document/purchaseOrder/show', compact('purchaseOrder', 'company_user', 'company_user_ids'));
    }
}
