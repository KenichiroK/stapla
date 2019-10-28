<?php

namespace App\Http\Controllers\Companies;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Http\Requests\Companies\TaskStatusRequest;
use Auth;

class TaskStatusController extends Controller
{
    public function change(TaskStatusRequest $request)
    {
        $auth = Auth::user();
        $task = Task::findOrFail($request->task_id);
        
        if($task->count()) {
            \Log::info('タスクstatus変更前', ['user_id(company)' => $auth->id, 'task_id' => $task->id, 'status' => $task->status]);
            $task->status = $request->status;
            $task->save();
            \Log::info('タスクstatus変更後', ['user_id(company)' => $auth->id, 'task_id' => $task->id, 'status' => $task->status]);
            return redirect()->route('company.task.show', ['id' => $task->id]);
        }
    }
}
