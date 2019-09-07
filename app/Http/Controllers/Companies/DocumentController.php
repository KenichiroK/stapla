<?php

namespace App\Http\Controllers\Companies;

use App\Models\Invoice;
use App\Models\PurchaseOrder;
use App\Models\Nda;
use App\Models\Task;
use App\Models\CompanyUser;
use App\Models\TaskCompany;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{

    public function index()
    {
        $auth_id = Auth::user()->id;
        $company_user = CompanyUser::where('auth_id', $auth_id)->first();
        
        // ionvoices
        $invoices = Invoice::where('company_id', $company_user->company_id)->with('task', 'task.taskCompanies', 'task.taskCompanies.companyUser')->get();
        // 担当者
        $task_id = Invoice::where('company_id', $company_user->company_id)->first()->task_id;
        
        // 未対応
        $invoices_0status = Invoice::where('company_id', $company_user->company_id)->where('status', 0)->get();
        // 他依頼中
        $invoices_1status = Invoice::where('company_id', $company_user->company_id)->where('status', 1)->get();
        // 依頼中
        $invoices_2status = Invoice::where('company_id', $company_user->company_id)->where('status', 2)->get();
        // 完了
        $invoices_3status = Invoice::where('company_id', $company_user->company_id)->where('status', 3)->get();
        
        // purhaseOrder
        $purchaseOrders = PurchaseOrder::where('company_id', $company_user->company_id)->with('task', 'task.taskCompanies', 'task.taskCompanies.companyUser')->get();
        // 未対応
        $purchaseOrders_0status = PurchaseOrder::where('company_id', $company_user->company_id)->where('status', 0)->get();
        // 他依頼中
        $purchaseOrders_1status = PurchaseOrder::where('company_id', $company_user->company_id)->where('status', 1)->get();
        // 依頼中
        $purchaseOrders_2status = PurchaseOrder::where('company_id', $company_user->company_id)->where('status', 2)->get();
        // 完了
        $purchaseOrders_3status = PurchaseOrder::where('company_id', $company_user->company_id)->where('status', 3)->get();
        
        // Nda
        $ndas = Nda::where('company_id', $company_user->company_id)->with('task', 'task.taskCompanies', 'task.taskCompanies.companyUser')->get();
        // 未対応
        $ndas_0status = Nda::where('company_id', $company_user->company_id)->where('status', 0)->get();
        // 他依頼中
        $ndas_1status = Nda::where('company_id', $company_user->company_id)->where('status', 1)->get();
        // 依頼中
        $ndas_2status = Nda::where('company_id', $company_user->company_id)->where('status', 2)->get();
        // 完了
        $ndas_3status = Nda::where('company_id', $company_user->company_id)->where('status', 3)->get();

        return view('company.document.index', 
            compact(
                'invoices', 'invoices_0status', 'invoices_1status', 'invoices_2status', 'invoices_3status',
                'purchaseOrders', 'purchaseOrders_0status', 'purchaseOrders_1status', 'purchaseOrders_2status', 'purchaseOrders_3status',
                'ndas', 'ndas_0status', 'ndas_1status', 'ndas_2status', 'ndas_3status', 'company_user'
            ));
    }
}
