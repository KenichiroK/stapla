<?php

namespace App\Http\Controllers\Partners;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\DeliverLog;
use App\Models\Partner;
use App\Models\Task;

class DeliverController extends Controller
{
    public function index()
    {
        //
    }

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
        $partner = Auth::user();
        $deliverLog = new DeliverLog;
        $deliverLog->task_id = $request->task_id;
        $deliverLog->partner_id = $partner->id;
        $deliverLog->save();

        if($task->count()) {
            $task->status = $request->status;
            $task->save();

            if ($task->status === 16) {
                return redirect()->route('partner.invoice.show', ['id' => $request->invoice_id]);
            }

            return redirect()->route('partner.task.show', ['id' => $task->id]);
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
