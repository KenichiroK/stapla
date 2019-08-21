<?php

namespace App\Http\Controllers\Companies;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Task;

class TaskStatusController extends Controller
{
    public function change(Request $request)
    {
        $task = Task::findOrFail($request->task_id);

        if($task->count()) {
            $task->status = $request->status;
            $task->save();

            return redirect()->route('company.task.show', ['id' => $task->id]);
        }
    }
}
