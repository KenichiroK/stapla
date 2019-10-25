<?php

namespace App\Http\Controllers\Companies;

use App\Http\Controllers\Controller;
use App\Http\Requests\Companies\CreateTaskRequest;
use App\Models\Task;
use App\Models\Project;
use App\Models\Partner;
use App\Models\CompanyUser;
use App\Models\PurchaseOrder;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $company_user = Auth::user();
        $tasks = Task::where('company_id', $company_user->company_id)
                                ->whereNotIn('status', [17, 18])
                                ->with(['project', 'partner', 'taskRoleRelation'])
                                ->get();

        $status_arr = [];
        for ($i = 0; $i < 19; $i++) {
            $status_arr[strval($i)] = 0;
        }
        for ($i = 0; $i < $tasks->count(); $i++) {
            $status_arr[$tasks[$i]->status]++;
        }

        $statusName_arr = [
            // タスク
            'タスク下書き',
            'タスク上長確認中',
            'タスクパートナー依頼前',
            'タスクパートナー確認中',
            '発注書作成前',
            // 発注書
            '発注書上長確認中',
            '発注書パートナー依頼前',
            '発注書パートナー確認中',
            '作業前',
            // 作業中
            '作業中',
            '検品中',
            '請求書作成前',
            // 請求書
            '請求書下書き',
            '請求書担当者確認前',
            '担当者確認中',
            '経理確認中',
            '経理承認済',
            // その他
            '完了',
            'キャンセル', 
        ];

        return view('company/task/index', compact('tasks','statusName_arr', 'status_arr', 'company_user'));
    }

    public function statusIndex($task_status)
    {
        $company_user = Auth::user();
        $alltasks = Task::where('company_id', $company_user->company_id)
                                    ->with(['project', 'companyUser', 'partner', 'taskRoleRelation'])
                                    ->get();
        $status_arr = [];
        for ($i = 0; $i < 19; $i++) {
            $status_arr[strval($i)] = 0;
        }
        for ($i = 0; $i < $alltasks->count(); $i++) {
            $status_arr[$alltasks[$i]->status]++;
        }

        $statusName_arr = [
            // タスク
            'タスク下書き',
            'タスク上長確認中',
            'タスクパートナー依頼前',
            'タスクパートナー確認中',
            '発注書作成前',
            // 発注書
            '発注書上長確認中',
            '発注書パートナー依頼前',
            '発注書パートナー確認中',
            '作業前',
            // 作業中
            '作業中',
            '検品中',
            '請求書作成前',
            // 請求書
            '請求書下書き',
            '請求書担当者確認前',
            '担当者確認中',
            '経理確認中',
            '経理承認済',
            // その他
            '完了',
            'キャンセル',
        ];

        $tasks = Task::where('company_id', $company_user->company_id)
                                ->where('status', $task_status)
                                ->with(['project', 'companyUser', 'partner', 'taskRoleRelation'])
                                ->get();
        return view('company/task/index', compact('tasks','statusName_arr', 'status_arr', 'company_user'));
    }

    public function projectTaskIndex($project_uid)
    {
        return Task::where('project_id', $project_uid)->get();
    }

    public function create()
    {
        $company_user = Auth::user();
        $projects = Project::where('company_id', $company_user->company_id)->where('status', '!=', 17)->get();
        
        $companyUsers = CompanyUser::where('company_id', $company_user->company_id)->get();
        $partners = Partner::where('company_id', $company_user->company_id)->get();
        return view('company/task/create', compact('projects','companyUsers', 'partners', 'company_user'));
    }

    // 保存
    public function store(CreateTaskRequest $request)
    {
        $task = new Task;
        $task->project_id      = $request->project_id;
        $company_id = Auth::user()->company_id;
        $task->company_id      = $company_id;
        $task->company_user_id = $request->company_user_id;
        $task->superior_id     = $request->superior_id;
        $task->accounting_id   = $request->accounting_id;
        $task->partner_id      = $request->partner_id;
        $task->name            = $request->task_name;
        $task->content         = $request->task_content;
        $task->started_at      = date('Y-m-d-H-m-s', strtotime($request->started_at));
        $task->ended_at        = date('Y-m-d-H-m-s', strtotime($request->ended_at));
        $task->status          = 1;
        $task->purchaseorder   = false;
        $task->invoice         = false;
        $task->budget          = $request->budget;
        $task->tax             = 0.1;
        $task->price           = $request->price;
        $task->cases           = 1;
        $task->fee_format      = "固定";
        $task->save();

        return redirect()->route('company.task.show', ['id' => $task->id])->with('completed', '「'.$task->name.'」を作成しました。');
    }

    public function show($id)
    {
        $task = Task::findOrFail($id);
        $purchaseOrder = PurchaseOrder::where('task_id', $id)->first();
        $invoice = Invoice::where('task_id', $id)->first();
        $company_user = Auth::user();
        $companyUsers = CompanyUser::where('company_id', $company_user->company_id)->get();

        $company_user_ids = array();
        if ($task->companyUser) {
            array_push($company_user_ids, $task->companyUser->id);
        }

        $partners = Partner::where('company_id', $company_user->company_id)->get();

        return view('/company/task/show', compact('task', 'project_count', 'company_user', 'companyUsers', 'partners', 'purchaseOrder', 'invoice', 'company_user_ids'));
    }
}