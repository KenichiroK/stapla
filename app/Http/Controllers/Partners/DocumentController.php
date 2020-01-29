<?php

namespace App\Http\Controllers\Partners;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\OutsourceContract;
use App\Models\Partner;
use App\Models\PurchaseOrder;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{
    public function index()
    {
        $partner = Auth::user();
        $invoices = Invoice::where('partner_id', $partner->id)->get(); 
        $purchaseOrders = PurchaseOrder::where('partner_id', $partner->id)->get();
        $outsourceContracts = OutsourceContract::where('partner_id', $partner->id)->get();

        return view('partner.document.index', compact('invoices', 'purchaseOrders', 'outsourceContracts'));
    }

    // NOTE: partnerのdocument周りがリファクタされるまでは接尾語にOutsource付けて対応
    public function editOutsource($outsource_contract_id)
    {
        $outsourceContract = OutsourceContract::findOrFail($outsource_contract_id);
        return view('partner.document.outsourceContract.edit', compact('outsourceContract'));
    }

    // TODO: バリデーション
    public function updateOutsourceComment(Request $request)
    {
        $outsourceContract = OutsourceContract::findOrFail($request->id);
        $outsourceContract->comment = $request->comment;
        $outsourceContract->save();
        return redirect()->route('partner.document.index');
    }

    // TODO: バリデーション
    public function updateOutsourceStatus(Request $request)
    {
        $outsourceContract = OutsourceContract::findOrFail($request->id);
        $outsourceContract->status = $request->status;
        $outsourceContract->save();
        return redirect()->route('partner.document.index');
    }
}
