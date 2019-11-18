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
    public function store(Request $request)
    {
        return 'test';
        return $task = Task::findOrFail($request->task_id);
        $auth = Auth::user();
        
        $deliverLog = new DeliverLog;
        $deliverLog->task_id = $request->task_id;
        $deliverLog->partner_id = $auth->id;
        $deliverLog->save();

        if($task->count()) {
            $task->status = (int)$request->status;
            $task->save();

            \Log::info('納品履歴', ['user_id(partner)' => $auth->id, 'task_id' => $task->id]);

            sendNotificationUpdatedTaskStatusFromPartner($task);
            sendNotificationUpdatedTaskStatusToProjectCompany($task);

            if ($task->status === config('const.APPROVAL_ACCOUNTING')) {
                return redirect()->route('partner.invoice.show', ['id' => $request->invoice_id]);
            }

            return redirect()->route('partner.task.show', ['id' => $task->id]);
        }
    } 
}
