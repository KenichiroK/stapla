<?php

namespace App\Http\Controllers\Partners;

use App\Http\Controllers\Controller;
use App\Models\CompanyUser;
use App\Models\Deliver;
use App\Models\Partner;
use App\Models\PurchaseOrder;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Validator;

class TaskController extends Controller
{
    public function index()
    {
        $partner = Auth::user();
        $tasks = Task::where('partner_id', $partner->id)
                                ->whereNotIn('status', [config('const.COMPLETE_STAFF'), config('const.TASK_CANCELED')])
                                ->get();
        return view('partner/task/index', compact('tasks'));
    }
    
    public function statusIndex($task_status)
    {
        $partner = Auth::user();
        $alltasks = Task::where('company_id', $partner->company_id)
                                    ->with(['project', 'companyUser', 'partner', 'taskRoleRelation'])
                                    ->get();
        
        $status_arr = [];
        for ($i = 0; $i < 19; $i++) {
            $status_arr[strval($i)] = 0;
        }
        for ($i = 0; $i < $alltasks->count(); $i++) {
            $status_arr[$alltasks[$i]->status]++;
        }

        // タスクステータスを外部ファイルで定数化（congfig/const.php）
        $statusName_arr = config('const.TASK_STATUS_LIST');

        $tasks = Task::where('company_id', $partner->company_id)
                                ->where('status', $task_status)
                                ->with(['project', 'companyUser', 'partner', 'taskRoleRelation'])
                                ->get();

        return view('partner/task/index', compact('partner', 'tasks', 'statusName_arr', 'status_arr'));
    }

    public function show($id)
    {
        $task = Task::findOrFail($id);
        $purchaseOrder = PurchaseOrder::where('task_id', $id)->first();

        $partner = Auth::user();

        if($task->deliver){
            $deliver = Deliver::where('task_id', $task->id)->first();
            $deliver->deliver_files = json_decode($deliver->deliver_files);
        }

        return view('/partner/task/show', compact('task', 'purchaseOrder', 'deliver'));
    }
}
