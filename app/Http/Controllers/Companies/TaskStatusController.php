<?php

namespace App\Http\Controllers\Companies;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

use App\Models\Task;
use App\Http\Requests\Companies\TaskStatusRequest;

class TaskStatusController extends Controller
{
    public function change(TaskStatusRequest $request)
    {
        $auth = Auth::user();
        $task = Task::findOrFail($request->task_id);
        
        if($task->count()) {
            \Log::info('タスクstatus変更前', ['user_id(company)' => $auth->id, 'task_id' => $task->id, 'status' => $task->status]);
            $prev_status = $task->status;
            $task->status = (int)$request->status;
            $task->save();

            sendNotificationUpdatedTaskStatusFromCompany($task, $prev_status);
            sendNotificationUpdatedTaskStatusToProjectCompany($task);

            \Log::info('タスクstatus変更後', ['user_id(company)' => $auth->id, 'task_id' => $task->id, 'status' => $task->status]);
            return redirect()->route('company.task.show', ['id' => $task->id]);
        }
    }
}
