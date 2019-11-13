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

        return view('company/task/index', compact('tasks','statusName_arr', 'status_arr'));
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
        return view('company/task/index', compact('tasks','statusName_arr', 'status_arr'));
    }

    public function projectTaskIndex($project_uid)
    {
        return Task::where('project_id', $project_uid)->get();
    }

    public function create()
    {
        $company_user = Auth::user();
        $projects = Project::where('company_id', $company_user->company_id)->where('status', '!=', config('const.PROJECT_COMPLETE'))->get();
        
        $company_users = CompanyUser::where('company_id', $company_user->company_id)->get();
        $partners = Partner::where('company_id', $company_user->company_id)->get();
        $task = null;
        // プレビューから戻ってくるときに使用する変数
        $response = '';
        return view('company/task/create', compact('projects', 'company_users', 'partners', 'task', 'response'));
    }

    public function temporary($task_id)
    {
        $task = Task::findOrFail($task_id);
        $company_user = Auth::user();
        $projects = Project::where('company_id', $company_user->company_id)->where('status', '!=', config('const.PROJECT_COMPLETE'))->get();
        
        $company_users = CompanyUser::where('company_id', $company_user->company_id)->get();
        $partners = Partner::where('company_id', $company_user->company_id)->get();
        // プレビューから戻ってくるときに使用する変数
        $response = '';
        return view('company/task/create', compact('projects', 'company_users', 'partners', 'task', 'response'));
    }

    // プレビュー
    public function preview(CreateTaskRequest $request)
    {
        switch ($request->input('temporarySaveOrPreview')){
            case 'toTemporarySave':
                $company_user = Auth::user();
                $task = new Task;
                $task->company_id      = $company_user->company_id;
                $task->project_id = $request->project_id;
                $task->name = $request->name;
                $task->status          = config('const.TASK_CREATE');
                $task->purchaseorder   = false;
                $task->invoice         = false;
                $task->tax             = config('const.FREE_TAX');
                $task->cases           = 0;
                $task->fee_format      = "固定";
                if(isset($request->company_user_id)){
                    $task->company_user_id = $request->company_user_id;
                }
                if(isset($request->superior_id)){
                    $task->superior_id = $request->superior_id;
                }
                if(isset($request->accounting_id)){
                    $task->accounting_id = $request->accounting_id;
                }
                if(isset($request->projet_id)){
                    $task->partner_id = $request->partner_id;
                }
                if(isset($request->content)){
                    $task->content = $request->content;
                }
                if(isset($request->started_at)){
                    $task->started_at = Carbon::createFromTimestamp(strtotime($request->started_at))
                                        ->format('Y-m-d-H-i-s');
                }
                if(isset($request->ended_at)){
                    $task->ended_at = Carbon::createFromTimestamp(strtotime($request->ended_at))
                                        ->format('Y-m-d-H-i-s');
                }
                if(isset($request->budget)){
                    $task->budget = $request->budget;
                }
                if(isset($request->price)){
                    $task->price = $request->price;
                }
                $task->save();

            return redirect()->route('company.task.temporary' ,['task_id' => $task->id])
                                ->withInput($request->all())
                                ->with('completed', '「'.$task->name.'」を下書きとして保存しました。');

            break;

            case 'toTemporaryUpdate':
                $task = Task::findOrFail($request->task_id);

                $task->project_id      = $request->project_id;
                $task->name = $request->name;

                if(isset($request->company_user_id)){
                    $task->company_user_id = $request->company_user_id;
                }
                if(isset($request->superior_id)){
                    $task->superior_id = $request->superior_id;
                }
                if(isset($request->accounting_id)){
                    $task->accounting_id = $request->accounting_id;
                }
                if(isset($request->partner_id)){
                    $task->partner_id      = $request->partner_id;
                }
                if(isset($request->content)){
                    $task->content = $request->content;
                }
                if(isset($request->started_at)){
                    $task->started_at = Carbon::createFromTimestamp(strtotime($request->started_at))
                                        ->format('Y-m-d-H-i-s');
                }
                if(isset($request->ended_at)){
                    $task->ended_at = Carbon::createFromTimestamp(strtotime($request->ended_at))
                                        ->format('Y-m-d-H-i-s');
                }
                if(isset($request->budget)){
                    $task->budget = $request->budget;
                }
                if(isset($request->price)){
                    $task->price = $request->price;
                }
                $task->save();

                return redirect()->route('company.task.temporary', ['task_id' => $task->id])
                                ->withInput($request->all())
                                ->with('completed', '「'.$task->name.'」の下書きを更新しました。');
            break;

            case 'toPreview':
                $company_user = Auth::user();
                $project = Project::findOrFail($request->project_id);
                // 担当者
                $person_in_charge = CompanyUser::findOrFail($request->company_user_id);
                // 上長
                if(isset($request->superior_id)){
                    $superior_user = CompanyUser::findOrFail($request->superior_id);
                } else{
                    $superior_user = null;
                }
                // 経理
                if(isset($request->accounting_id)){
                    $accounting_user = CompanyUser::findOrFail($request->accounting_id);
                } else{
                    $accounting_user = null;
                }
                // パートナー
                $partner = Partner::findORFail($request->partner_id);
                // タスクステータス
                $task_status = 0;
        
                return view('company.task.preview', compact('request', 'company_user', 'project', 'person_in_charge', 'superior_user', 'accounting_user', 'partner', 'task_status'));
            break;
                
            default:
                \abort('400', '要求の形式が正しくありません。');
        }
    }

    // 保存
    public function store(Request $request)
    {
        switch ($request->input('editOrStore')) {
            case 'toEdit':
                return redirect()->route('company.task.create')->withInput($request->all());
            break;

            case 'toStore':
            $company_user = Auth::user();
            $task = new Task;
            $task->project_id      = $request->project_id;
            $task->company_id      = $company_user->company_id;
            $task->company_user_id = $request->company_user_id;
            $task->superior_id     = $request->superior_id;
            $task->accounting_id   = $request->accounting_id;
            $task->partner_id      = $request->partner_id;
            $task->name            = $request->name;
            $task->content         = $request->content;
            $task->started_at      = Carbon::createFromTimestamp(strtotime($request->started_at))->format('Y-m-d-H-i-s');
            $task->ended_at        = Carbon::createFromTimestamp(strtotime($request->ended_at))->format('Y-m-d-H-i-s');
            $task->status          = config('const.TASK_SUBMIT_SUPERIOR');
            $task->purchaseorder   = false;
            $task->invoice         = false;
            $task->budget          = $request->budget;
            $task->tax             = config('const.FREE_TAX');
            $task->price           = $request->price;
            $task->cases           = 1;
            $task->fee_format      = "固定";
            $task->save();
            \Log::info('タスク新規作成', ['user_id(company)' => $company_user->id, 'task_id' => $task->id, 'status' => $task->status]);
    
            return redirect()->route('company.task.show', ['id' => $task->id])->with('completed', '「'.$task->name.'」を作成しました。');
            break;
        }
    }

    public function show($id)
    {
        $task = Task::findOrFail($id);
        $purchaseOrder = PurchaseOrder::where('task_id', $id)->first();
        $invoice = Invoice::where('task_id', $id)->first();
        $company_user = Auth::user();
        $company_users = CompanyUser::where('company_id', $company_user->company_id)->get();

        $company_user_ids = array();
        if ($task->companyUser) {
            array_push($company_user_ids, $task->companyUser->id);
        }

        $partners = Partner::where('company_id', $company_user->company_id)->get();

        return view('/company/task/show', compact('task', 'project_count', 'company_user', 'company_users', 'partners', 'purchaseOrder', 'invoice', 'company_user_ids'));
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
