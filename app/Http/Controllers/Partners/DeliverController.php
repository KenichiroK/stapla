<?php

namespace App\Http\Controllers\Partners;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use App\Models\DeliverLog;
use App\Models\Partner;
use App\Models\Task;
use App\Models\CompanyUser;

class DeliverController extends Controller
{
    public function create($task_id)
    {
        // task_id;
        $partner = Auth::user();
        $task = Task::findOrFail($task_id);
        return view('partner/deliver/create', compact('partner', 'task'));
    }

    public function store(Request $request)
    {
        $task = Task::findOrFail($request->task_id);
        $auth = Auth::user();
        
        $deliverLog = new DeliverLog;
        $deliverLog->task_id = $request->task_id;
        $deliverLog->partner_id = $auth->id;
        $deliverLog->save();

        if($task->count()) {
            $prev_status = $task->status;
            $task->status = (int)$request->status;
            $task->save();


            \Log::info('納品履歴', ['user_id(partner)' => $auth->id, 'task_id' => $task->id]);

            sendNotificationUpdatedTaskStatusFromPartner($task, $prev_status);
            sendNotificationUpdatedTaskStatusToProjectCompany($task, $prev_status);

            if ($task->status === config('const.APPROVAL_ACCOUNTING')) {
                return redirect()->route('partner.invoice.show', ['id' => $request->invoice_id]);
            }

            return redirect()->route('partner.task.show', ['id' => $task->id]);
        }
    } 
}
