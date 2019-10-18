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
        $company_user = Auth::user();
        
        // ionvoices
        $invoices = Invoice::where('company_id', $company_user->company_id)->with('task', 'task.taskCompanies', 'task.taskCompanies.companyUser')->get(); 
        // 他依頼中
        $invoices_1status = Invoice::where('company_id', $company_user->company_id)->where('status', 1)->get();
        // 依頼中
        $invoices_2status = Invoice::where('company_id', $company_user->company_id)->where('status', 2)->get();
        // 完了
        $invoices_3status = Invoice::where('company_id', $company_user->company_id)->where('status', 3)->get();
        
        // purhaseOrder
        $purchaseOrders = PurchaseOrder::where('company_id', $company_user->company_id)->with('task', 'task.taskCompanies', 'task.taskCompanies.companyUser')->get();
        // 他依頼中
        $purchaseOrders_1status = PurchaseOrder::where('company_id', $company_user->company_id)->where('status', 1)->get();
        // 依頼中
        $purchaseOrders_2status = PurchaseOrder::where('company_id', $company_user->company_id)->where('status', 2)->get();
        // 完了
        $purchaseOrders_3status = PurchaseOrder::where('company_id', $company_user->company_id)->where('status', 3)->get();
        
        return view('company.document.index', 
            compact(
                'invoices', 'invoices_1status', 'invoices_2status', 'invoices_3status',
                'purchaseOrders', 'purchaseOrders_1status', 'purchaseOrders_2status', 'purchaseOrders_3status',
                'company_user'
            ));
    }
}
