<?php

namespace App\Http\Controllers\Partners;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PurchaseOrder;
use App\Models\Partner;
use Illuminate\Support\Facades\Auth;

class PurchaseOrderController extends Controller
{
    public function show($id)
    {
        $purchaseOrder = PurchaseOrder::findOrFail($id);
        $partner = Auth::user();
        if($purchaseOrder->partner->id !== $partner->id) {
            return 'アカウントをお確かめください';
        }
        return view('partner/document/purchaseOrder/show', compact('purchaseOrder'));
    }
}
