<?php

namespace App\Http\Controllers\Partners;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Http\Requests\Partners\TaskStatusRequest;

class TaskStatusController extends Controller
{
    public function change(TaskStatusRequest $request)
    {
        $task = Task::findOrFail($request->task_id);

        if($task->count()) {
            $task->status = $request->status;
            $task->save();

            if ($task->status === 17) {
                return redirect()->route('partner.invoice.show', ['id' => $request->invoice_id]);
            }

            return redirect()->route('partner.task.show', ['id' => $task->id]);
        }
    }
}
