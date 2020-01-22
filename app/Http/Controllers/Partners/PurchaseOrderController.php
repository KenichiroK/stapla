<?php

namespace App\Http\Controllers\Partners;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PurchaseOrder;
use App\Models\Partner;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class PurchaseOrderController extends Controller
{
    public function show($id)
    {
        $purchaseOrder = PurchaseOrder::findOrFail($id);
        $task = Task::findOrFail($purchaseOrder->task_id);
        $partner = Auth::user();
        if($purchaseOrder->partner->id !== $partner->id) {
            return 'アカウントをお確かめください';
        }
        return view('partner/document/purchaseOrder/show', compact('purchaseOrder', 'task'));
    }
}
