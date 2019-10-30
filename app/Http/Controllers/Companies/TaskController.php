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
use Illuminate\Support\Facades\Config;

class TaskController extends Controller
{
    public function index()
    {
        $companyUser = Auth::user();
        $tasks = Task::where('company_id', $companyUser->company_id)
                                ->whereNotIn('status', [config('const.COMPLETE_STAFF'), config('const.TASK_CANCELED')])
                                ->with(['project', 'partner', 'taskRoleRelation'])
                                ->get();

        $status_arr = [];
        for ($i = 0; $i <= config('const.TASK_CANCELED'); $i++) {
            $status_arr[strval($i)] = 0;
        }
        for ($i = 0; $i < $tasks->count(); $i++) {
            $status_arr[$tasks[$i]->status]++;
        }

        // タスクステータスを外部ファイルで定数化（congfig/const.php）
        $statusName_arr = config('const.TASK_STATUS_LIST');

        return view('company/task/index', compact('tasks','statusName_arr', 'status_arr', 'companyUser'));
    }

    public function statusIndex($task_status)
    {
        $companyUser = Auth::user();
        $alltasks = Task::where('company_id', $companyUser->company_id)
                                    ->with(['project', 'companyUser', 'partner', 'taskRoleRelation'])
                                    ->get();
        $status_arr = [];
        for ($i = 0; $i <= config('const.TASK_CANCELED'); $i++) {
            $status_arr[strval($i)] = 0;
        }
        for ($i = 0; $i < $alltasks->count(); $i++) {
            $status_arr[$alltasks[$i]->status]++;
        }

        // タスクステータスを外部ファイルで定数化（congfig/const.php）
        $statusName_arr = config('const.TASK_STATUS_LIST');

        $tasks = Task::where('company_id', $companyUser->company_id)
                                ->where('status', $task_status)
                                ->with(['project', 'companyUser', 'partner', 'taskRoleRelation'])
                                ->get();
        return view('company/task/index', compact('tasks','statusName_arr', 'status_arr', 'companyUser'));
    }

    public function projectTaskIndex($project_uid)
    {
        return Task::where('project_id', $project_uid)->get();
    }

    public function create()
    {
        $companyUser = Auth::user();
        $projects = Project::where('company_id', $companyUser->company_id)->where('status', '!=', config('const.COMPLETE_STAFF'))->get();
        
        $companyUsers = CompanyUser::where('company_id', $companyUser->company_id)->get();
        $partners = Partner::where('company_id', $companyUser->company_id)->get();
        // プレビューから戻ってくるときに使用する変数
        $response = '';
        return view('company/task/create', compact('projects','companyUsers', 'partners', 'companyUser'));
    }

    // プレビュー
    public function preview(CreateTaskRequest $request)
    {
        $companyUser = Auth::user();
        $project = Project::findOrFail($request->project_id);
        // 担当者
        $companyUser = CompanyUser::findOrFail($request->company_user_id);
        // 上長
        if(isset($request->superior_id)){
            $superiorUser = CompanyUser::findOrFail($request->superior_id);
        } else{
            $superiorUser = null;
        }
        // 経理
        if(isset($request->accounting_id)){
            $accountingUser = CompanyUser::findOrFail($request->accounting_id);
        } else{
            $accountingUser = null;
        }
        // パートナー
        $partner = Partner::findORFail($request->partner_id);
        // タスクステータス
        $task_status = 0;

        return view('company.task.create', compact('request', 'companyUsers', 'project', 'companyUser', 'superiorUser', 'accountingUser', 'partner', 'task_status'));
    }

    // 保存
    public function store(Request $request)
    {
        switch ($request->input('action')) {
            case 'toEdit';
                // return $request;
                $companyUser = Auth::user();
                $companyUsers = CompanyUser::where('company_id', $companyUser->company_id)->get();
                $projects = Project::where('company_id', $companyUser->company_id)->where('status', '!=', config('const.COMPLETE_STAFF'))->get();
                // 担当者
                $companyUser = CompanyUser::findOrFail($request->company_user_id);
                // 上長
                if(isset($request->superior_id)){
                    $superiorUser = CompanyUser::findOrFail($request->superior_id);
                } else{
                    $superiorUser = null;
                }
                // 経理
                if(isset($request->accounting_id)){
                    $accountingUser = CompanyUser::findOrFail($request->accounting_id);
                } else{
                    $accountingUser = null;
                }
                // パートナー
                $partner = Partner::findORFail($request->partner_id);
                $partners = Partner::where('company_id', $companyUser->company_id)->get();
                // タスクステータス
                $task_status = 0;

                $response = $request;
                // return $response;

                return view('company.task.create', compact('response', 'companyUsers', 'projects', 'companyUser', 'superiorUser', 'accountingUser', 'partner', 'partners', 'task_status'));
            break;

            case 'toStore';
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
            break;
        }
    }

    public function show($id)
    {
        $task = Task::findOrFail($id);
        $purchaseOrder = PurchaseOrder::where('task_id', $id)->first();
        $invoice = Invoice::where('task_id', $id)->first();
        $companyUser = Auth::user();
        $companyUsers = CompanyUser::where('company_id', $companyUser->company_id)->get();

        $company_user_ids = array();
        if ($task->companyUser) {
            array_push($company_user_ids, $task->companyUser->id);
        }

        $partners = Partner::where('company_id', $companyUser->company_id)->get();

        return view('/company/task/show', compact('task', 'project_count', 'companyUser', 'companyUsers', 'partners', 'purchaseOrder', 'invoice', 'company_user_ids'));
    }
}