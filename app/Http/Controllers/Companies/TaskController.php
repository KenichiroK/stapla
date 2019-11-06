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
use Carbon\Carbon;

class TaskController extends Controller
{
    public function index()
    {
        $company_user = Auth::user();
        $tasks = Task::where('company_id', $company_user->company_id)
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

        return view('company/task/index', compact('tasks','statusName_arr', 'status_arr', 'company_user'));
    }

    public function statusIndex($task_status)
    {
        $company_user = Auth::user();
        $alltasks = Task::where('company_id', $company_user->company_id)
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
        $projects = Project::where('company_id', $company_user->company_id)->where('status', '!=', config('const.PROJECT_COMPLETE'))->get();
        
        $companyUsers = CompanyUser::where('company_id', $company_user->company_id)->get();
        $partners = Partner::where('company_id', $company_user->company_id)->get();
        return view('company/task/create', compact('projects','companyUsers', 'partners', 'company_user'));
    }

    // 保存
    public function store(CreateTaskRequest $request)
    {
        $auth = Auth::user();

        $task = new Task;
        $task->project_id      = $request->project_id;
        $task->company_id      = $auth->company_id;
        $task->company_user_id = $request->company_user_id;
        $task->superior_id     = $request->superior_id;
        $task->accounting_id   = $request->accounting_id;
        $task->partner_id      = $request->partner_id;
        $task->name            = $request->name;
        $task->content         = $request->content;
        $task->started_at      = Carbon::createFromTimestamp(strtotime($request->started_at))->format('Y-m-d-H-i-s');
        $task->ended_at        = Carbon::createFromTimestamp(strtotime($request->ended_at))->format('Y-m-d-H-i-s');
        $task->status          = 1;
        $task->purchaseorder   = false;
        $task->invoice         = false;
        $task->budget          = $request->budget;
        $task->tax             = 0.1;
        $task->price           = $request->price;
        $task->cases           = 1;
        $task->fee_format      = "固定";
        $task->save();
        \Log::info('タスク新規作成', ['user_id(company)' => $auth->id, 'task_id' => $task->id, 'status' => $task->status]);

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

    public function edit($id)
    {
        $company_user = Auth::user();
        $task = Task::findOrFail($id);
        $projects = Project::where('company_id', $company_user->company_id)->where('status', '!=', 1)->get();
            
        $companyUsers = CompanyUser::where('company_id', $company_user->company_id)->get();
        $partners = Partner::where('company_id', $company_user->company_id)->get();

        return view('company/task/edit', compact('task', 'projects','companyUsers', 'partners', 'company_user')); 
    }

    public function update(CreateTaskRequest $request, $id)
    {
        $task = Task::findOrFail($id);

        $task->project_id      = $request->project_id;
        $task->company_user_id = $request->company_user_id;
        $task->superior_id     = $request->superior_id;
        $task->accounting_id   = $request->accounting_id;
        $task->partner_id      = $request->partner_id;
        $task->name            = $request->name;
        $task->content         = $request->content;
        $task->started_at      = Carbon::createFromTimestamp(strtotime($request->started_at))->format('Y-m-d-H-i-s');
        $task->ended_at        = Carbon::createFromTimestamp(strtotime($request->ended_at))->format('Y-m-d-H-i-s');
        $task->budget          = $request->budget;
        $task->price           = $request->price;
        $task->save();
        

        return redirect()->route('company.task.show', ['id' => $task->id])->with('completed', '変更しました。');
    }
}
