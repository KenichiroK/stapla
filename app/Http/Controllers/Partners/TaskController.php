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
    public function index()
    {
        $partner = Auth::user();
        return view('partner/task/index', compact('partner'));
    }

    public function show($id)
    {
        $task = Task::findOrFail($id);
        $purchaseOrder = PurchaseOrder::where('task_id', $id)->first();

        $partner = Auth::user();

        return view('/partner/task/show', compact('task', 'partner', 'purchaseOrder'));
    }
}
