<?php

namespace App\Http\Controllers\Partners;

use App\Http\Controllers\Controller;
use App\Models\CompanyUser;
use App\Models\Deliver;
use App\Models\Partner;
use App\Models\PurchaseOrder;
use App\Models\Task;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Validator;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::where('partner_id', Auth::user()->id)
                        ->whereNotIn('status', [config('const.TASK_CREATE'), config('const.TASK_SUBMIT_SUPERIOR'), config('const.TASK_APPROVAL_SUPERIOR'), config('const.COMPLETE_STAFF')])
                        ->orderBy('created_at', 'desc')
                        ->get();

        $status_arr = [];
        foreach (config('const.TASK_STATUS_ARR') as $key => $TASK_STATUS) {
            $status_arr[$key] = $tasks->where('status', config('const')[$TASK_STATUS])->count();
        }

        $shown_task_status = null;
        
        return view('partner/task/index/index', compact('tasks', 'status_arr', 'shown_task_status'));
    }
    
    public function statusIndex($task_status)
    {
        $partner = Auth::user();
        $all_tasks = Task::where('partner_id', Auth::user()->id)
                            ->whereNotIn('status', [config('const.TASK_CREATE'), config('const.TASK_SUBMIT_SUPERIOR'), config('const.TASK_APPROVAL_SUPERIOR'), config('const.COMPLETE_STAFF')])
                            ->orderBy('created_at', 'desc')
                            ->get();
        
        $status_arr = [];
        foreach (config('const.TASK_STATUS_ARR') as $key => $TASK_STATUS) {
            $status_arr[$key] = $all_tasks->where('status', config('const')[$TASK_STATUS])->count();
        }

        $shown_task_status = (integer)$task_status;

        $tasks = Task::where('partner_id', Auth::user()->id)
                        ->orderBy('created_at', 'desc')
                        ->get();

        if ($task_status === config('const.SUBMIT_STAFF')) {
            $tasks = $tasks->where('status', $task_status)
                            ->orWhere('status', config('const.SUBMIT_ACCOUNTING'));
        } else {
            $tasks = $tasks->where('status', $task_status);
        }

        return view('partner/task/index/index', compact('tasks', 'status_arr', 'shown_task_status'));
    }

    public function show($id)
    {
        $task = Task::findOrFail($id);
        $invoice = Invoice::where('task_id', $id)->first();
        $purchaseOrder = PurchaseOrder::where('task_id', $id)->first();

        $partner = Auth::user();

        if($task->deliver){
            $deliver = Deliver::where('task_id', $task->id)->first();
            $deliver_items = $deliver->deliverItems;
        }

        return view('/partner/task/show', compact('task', 'invoice', 'purchaseOrder', 'deliver', 'deliver_items'));
    }
}
