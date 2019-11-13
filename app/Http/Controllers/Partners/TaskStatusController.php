<?php

namespace App\Http\Controllers\Partners;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

use App\Models\Task;
use App\Http\Requests\Partners\TaskStatusRequest;

class TaskStatusController extends Controller
{
    public function change(TaskStatusRequest $request)
    {
        $auth = Auth::user();
        $task = Task::findOrFail($request->task_id);

        if($task->count()) {
            \Log::info('タスクstatus変更前', ['user_id(partner)' => $auth->id, 'task_id' => $task->id, 'status' => $task->status]);
            $task->status = (int)$request->status;
            $task->save();

            sendNotificationUpdatedTaskStatusFromPartner($task);
            sendNotificationUpdatedTaskStatusToProjectCompany($task);

            \Log::info('タスクstatus変更後', ['user_id(partner)' => $auth->id, 'task_id' => $task->id, 'status' => $task->status]);

            if ($task->status === config('const.COMPLETE_STAFF')) {
                return redirect()->route('partner.invoice.show', ['id' => $request->invoice_id]);
            }
            return redirect()->route('partner.task.show', ['id' => $task->id]);
        }
    }
}
