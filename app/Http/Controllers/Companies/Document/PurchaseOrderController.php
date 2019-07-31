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
    public function index()
    {
        //
    }

    public function create($id)
    {
        $auth = Auth::user();
        $task = Task::findOrFail($id);
        $companyUser = CompanyUser::where('auth_id', $auth->id)->first();

        $companyUsers = CompanyUser::where('company_id', $companyUser->company_id)->get();

        return view('/company/document/purchaseOrder/create', compact('companyUser', 'companyUsers', 'task'));
    }

    public function store(CreatePurchaseOrderRequest $request)
    {
        $auth = Auth::user();
        $companyUser = CompanyUser::where('auth_id', $auth->id)->first();
        $company = Company::findOrFail($companyUser->company_id);
        $tasks = Task::where('company_id', $company->id)->with(['taskPartners.partner'])->get();

        $task = Task::findOrFail($request->task_id);

        $purchaseOrder = new PurchaseOrder;
        $purchaseOrder->company_id = $company->id;
        $purchaseOrder->companyUser_id       = $request->companyUser_id;
        $purchaseOrder->partner_id           = $request->partner_id;
        $purchaseOrder->task_id              = $request->task_id;
        $purchaseOrder->status               = 0;
        $purchaseOrder->company_name         = $company->company_name;
        $purchaseOrder->company_tel          = $company->tel;
        $purchaseOrder->company_zip_code     = $company->zip_code;
        $purchaseOrder->company_prefecture   = $company->address_prefecture;
        $purchaseOrder->company_city         = $company->address_city;
        $purchaseOrder->company_building     = $company->address_building;
        $purchaseOrder->companyUser_name     = CompanyUser::findOrFail($request->companyUser_id)->name;
        $purchaseOrder->partner_name         = Partner::findOrFail($request->partner_id)->name;
        $purchaseOrder->task_name            = $request->task_name;
        $purchaseOrder->task_delivery_format = Task::findOrFail($request->task_id)->delivery_format;
        $purchaseOrder->task_ended_at        = Task::findOrFail($request->task_id)->ended_at;
        $purchaseOrder->task_price           = Task::findOrFail($request->task_id)->price;
        $purchaseOrder->task_tax             = Task::findOrFail($request->task_id)->tax;
        $purchaseOrder->save();

        return redirect()->route('company.document.purchaseOrder.show', [$purchaseOrder->id]);
    }

    public function show($id)
    {
        $purchaseOrder = PurchaseOrder::findOrFail($id);
        $auth = Auth::user();
        $company_user = CompanyUser::where('auth_id', $auth->id)->first();
        return view('company/document/purchaseOrder/show', compact('purchaseOrder', 'company_user'));
    }
    

    public function edit($id)
    {
        // 
    }

    public function update(Request $request, $id)
    {
        // 
    }

    public function destroy($id)
    {
        //
    }
}
