<?php

namespace App\Http\Controllers\Partners;

use App\Models\Partner;
use App\Models\Invoice;
use App\Models\PurchaseOrder;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{
    public function index()
    {
        $partner = Auth::user();
        $invoices = Invoice::where('partner_id', $partner->id)->get(); 
        $purchaseOrders = PurchaseOrder::where('partner_id', $partner->id)->get();

        return view('partner.document.index', compact('invoices', 'purchaseOrders'));
    }
}
