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
        $company_id = CompanyUser::where('auth_id', $auth_id)->first()->company_id;
        // ionvoices
        $invoices = Invoice::where('company_id', $company_id)->with('task')->get();
            // 未対応
            $invoices_0data = Invoice::where('company_id', $company_id)->where('status', 0)->get();
            // 他依頼中
            $invoices_1data = Invoice::where('company_id', $company_id)->where('status', 1)->get();
            // 依頼中
            $invoices_2data = Invoice::where('company_id', $company_id)->where('status', 2)->get();
            // 完了
            $invoices_3data = Invoice::where('company_id', $company_id)->where('status', 3)->get();
        // purhaseOrder
        $purchaseOrders = PurchaseOrder::where('company_id', $company_id)->with('task')->get();
            // 未対応
            $purchaseOrders_0data = PurchaseOrder::where('company_id', $company_id)->where('status', 0)->get();
            // 他依頼中
            $purchaseOrders_1data = PurchaseOrder::where('company_id', $company_id)->where('status', 1)->get();
            // 依頼中
            $purchaseOrders_2data = PurchaseOrder::where('company_id', $company_id)->where('status', 2)->get();
            // 完了
            $purchaseOrders_3data = PurchaseOrder::where('company_id', $company_id)->where('status', 3)->get();
        // Nda
        $ndas = Nda::where('company_id', $company_id)->with('task')->get();
            // 未対応
            $ndas_0data = Nda::where('company_id', $company_id)->where('status', 0)->get();
            // 他依頼中
            $ndas_1data = Nda::where('company_id', $company_id)->where('status', 1)->get();
            // 依頼中
            $ndas_2data = Nda::where('company_id', $company_id)->where('status', 2)->get();
            // 完了
            $ndas_3data = Nda::where('company_id', $company_id)->where('status', 3)->get();

        return view('company.document.index', 
                compact(
                    'invoices', 'invoices_0data', 'invoices_1data', 'invoices_2data', 'invoices_3data',
                    'purchaseOrders', 'purchaseOrders_0data', 'purchaseOrders_1data', 'purchaseOrders_2data', 'purchaseOrders_3data',
                    'ndas', 'ndas_0data', 'ndas_1data', 'ndas_2data', 'ndas_3data',
                    'test_count'
                ));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
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
