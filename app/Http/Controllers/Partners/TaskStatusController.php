<?php

namespace App\Http\Controllers\Partners;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Http\Requests\Partners\TaskStatusRequest;
use Auth;

class TaskStatusController extends Controller
{
    public function change(TaskStatusRequest $request)
    {
        $task = Task::findOrFail($request->task_id);

        if($task->count()) {
            $task->status = $request->status;
            $task->save();

            $auth = Auth::user();
            \Log::info('change task status', ['user_id(partner)' => $auth->id, 'task_id' => $task->id, 'status' => $task->status]);

            if ($task->status === config('const.COMPLETE_STAFF')) {
                return redirect()->route('partner.invoice.show', ['id' => $request->invoice_id]);
            }

            return redirect()->route('partner.task.show', ['id' => $task->id]);
        }
    }
}
