<?php

namespace App\Http\Controllers\Companies;

use App\Models\Invoice;
use App\Models\PurchaseOrder;
use App\Models\CompanyUser;
use App\Models\OutsourceContract;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{

    public function index()
    {
        $company_user = Auth::user();
        $invoices = Invoice::where('company_id', $company_user->company_id)->get(); 
        $purchaseOrders = PurchaseOrder::where('company_id', $company_user->company_id)->get();
        $outsourceContracts = OutsourceContract::where('company_id', $company_user->company_id)->get();
        
        return view('company.document.index', compact('invoices', 'purchaseOrders', 'company_user', 'outsourceContracts'));
    }
}
