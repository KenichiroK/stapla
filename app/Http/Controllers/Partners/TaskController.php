<?php

namespace App\Http\Controllers\Partners;

use App\Models\Task;
use App\Models\Partner;
use App\Models\CompanyUser;
use App\Models\PurchaseOrder;
use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function show($id)
    {
        $task = Task::findOrFail($id);
        $purchaseOrder = PurchaseOrder::where('task_id', $id)->first();


        $user = Auth::user();
        $partner = Partner::where('partner_id', $user->id)->get()->first();

        return view('/partner/task/show', compact('task', 'partner', 'purchaseOrder'));
    }
}
