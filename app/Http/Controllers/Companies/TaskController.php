<?php

namespace App\Http\Controllers\Companies;

use App\Http\Controllers\Controller;
use App\Http\Requests\Companies\TaskDraftRequest;
use App\Http\Requests\Companies\TaskUpdateDraftRequest;
use App\Http\Requests\Companies\TaskPreviewRequest;
use App\Models\CompanyUser;
use App\Models\Deliver;
use App\Models\Invoice;
use App\Models\Partner;
use App\Models\Project;
use App\Models\PurchaseOrder;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Notifications\DatabaseNotification;

class TaskController extends Controller
{
    public function index()
    {
        $auth = Auth::user();
        $tasks = Task::where('company_id', $auth->company_id)
                                ->whereNotIn('status', [config('const.COMPLETE_STAFF'), config('const.TASK_CANCELED')])
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
        $auth = Auth::user();
        $alltasks = Task::where('company_id', $auth->company_id)
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

        $tasks = Task::where('company_id', $auth->company_id)
                                ->where('status', $task_status)
                                ->get();
        return view('company/task/index', compact('tasks','statusName_arr', 'status_arr'));
    }

    public function projectTaskIndex($project_uid)
    {
        return Task::where('project_id', $project_uid)->get();
    }

    public function create(Request $request)
    {
        $auth = Auth::user();
        $company_users = CompanyUser::where('company_id', $auth->company_id)->get();
        $partners = Partner::where('company_id', $auth->company_id)->get();
        $task = '';

        if($request->query('pid')){
            $project_id = $request->query('pid');
            $project = Project::where('id', $project_id)->first();
            
            return view('company/task/create', compact('project', 'company_users', 'partners', 'company_user', 'task'));
        } else {
            $projects = Project::where('company_id', $auth->company_id)->where('status', '!=', config('const.PROJECT_COMPLETE'))->get();
            return view('company/task/create', compact('projects', 'company_users', 'partners', 'company_user', 'task'));
        }
    }

    // 下書き状態タスクの作成ページ
    public function createDraft($task_id)
    {
        $task = Task::findOrFail($task_id);
        $company_user = Auth::user();
        $projects = Project::where('company_id', $company_user->company_id)->where('status', '!=', config('const.PROJECT_COMPLETE'))->get();

        $company_users = CompanyUser::where('company_id', $company_user->company_id)->get();
        $partners = Partner::where('company_id', $company_user->company_id)->get();

        return view('company/task/create', compact('projects', 'company_users', 'partners', 'task', 'response'));
    }
    
    // 下書きとして保存
    public function draft(TaskDraftRequest $request)
    {
        $auth = Auth::user();
        $task = new Task;
        $task->company_id      = $auth->company_id;
        $task->project_id = $request->project_id;
        $task->name = $request->name;
        $task->started_at = Carbon::createFromTimestamp(strtotime($request->started_at))
                                ->format('Y-m-d-H-i-s');
        $task->ended_at = Carbon::createFromTimestamp(strtotime($request->ended_at))
                                ->format('Y-m-d-H-i-s');
        $task->status          = config('const.TASK_CREATE');
        $task->purchaseorder   = false;
        $task->invoice         = false;
        $task->tax             = config('const.FREE_TAX');
        $task->cases           = 0;
        $task->fee_format      = "固定";
        if($request->company_user_id){
            $task->company_user_id = $request->company_user_id;
        }
        if($request->superior_id){
            $task->superior_id = $request->superior_id;
        }
        if($request->accounting_id){
            $task->accounting_id = $request->accounting_id;
        }
        if($request->projet_id){
            $task->partner_id = $request->partner_id;
        }
        if($request->content){
            $task->content = $request->content;
        }
        if($request->budget){
            $task->budget = $request->budget;
        }
        if($request->partner_id){
            $task->partner_id = $request->partner_id;
        }
        if($request->price){
            $task->price = $request->price;
        }
        $task->save();

        return redirect()->route('company.task.createDraft' ,['task_id' => $task->id])
                                ->withInput($request->all())
                                ->with('completed', '「'.$task->name.'」を下書きとして保存しました。');
        
    }

    // 下書きを更新
    public function updateDraft(TaskUpdateDraftRequest $request)
    {
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
        if($request->partner_id){
            $task->partner_id = $request->partner_id;
        }
        if(isset($request->price)){
            $task->price = $request->price;
        }
        $task->save();

        return redirect()->route('company.task.createDraft', ['task_id' => $task->id])
                        ->withInput($request->all())
                        ->with('completed', '「'.$task->name.'」の下書きを更新しました。');
    }

    // プレビュー
    public function preview(TaskPreviewRequest $request)
    {
        // 下書きとして保存されているタスク
        if($request->task_id){
            $task = Task::findOrFail($request->task_id);
            $company_user = CompanyUser::findOrFail($request->company_user_id);
            $project = Project::findOrFail($request->project_id);
            $person_in_charge = CompanyUser::findOrFail($request->company_user_id);
            if(isset($request->superior_id)){
                $superior_user = CompanyUser::findOrFail($request->superior_id);
            } else{
                $superior_user = null;
            }
            if(isset($request->accounting_id)){
                $accounting_user = CompanyUser::findOrFail($request->accounting_id);
            } else{
                $accounting_user = null;
            }
            $partner = Partner::findORFail($request->partner_id);
            // タスクステータスを下書きに
            $task_status = config('const.TASK_CREATE');
    
            return view('company.task.preview', compact('request', 'task',  'company_user', 'project', 'person_in_charge', 'superior_user', 'accounting_user', 'partner', 'task_status'));

        // 新規タスク（下書き保存されていない）
        } else{
            $company_user = CompanyUser::findOrFail($request->company_user_id);
            $project = Project::findOrFail($request->project_id);
            $person_in_charge = CompanyUser::findOrFail($request->company_user_id);
            if(isset($request->superior_id)){
                $superior_user = CompanyUser::findOrFail($request->superior_id);
            } else{
                $superior_user = null;
            }
            if(isset($request->accounting_id)){
                $accounting_user = CompanyUser::findOrFail($request->accounting_id);
            } else{
                $accounting_user = null;
            }
            $partner = Partner::findORFail($request->partner_id);

            return view('company.task.preview', compact('request', 'company_user', 'project', 'person_in_charge', 'superior_user', 'accounting_user', 'partner'));
        }
    }

    // 再編集
    public function reCreate(Request $request)
    {
        if($request->task_id){
            $task = Task::findOrFail($request->task_id);
            return redirect()->route('company.task.createDraft' ,['task_id' => $task->id])
                                ->withInput($request->all());
        } else{
            $task = null;
            return redirect()->route('company.task.create')
                                ->withInput($request->all());
        }
    }

    // 保存
    public function store(Request $request)
    {
        // 下書き保存済みのタスクは更新
        if(isset($request->task_id)){
            $task = Task::findOrFail($request->task_id);
            $auth = Auth::user();
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
            $task->status          = config('const.TASK_SUBMIT_SUPERIOR');
            $task->purchaseorder   = false;
            $task->invoice         = false;
            $task->budget          = $request->budget;
            $task->tax             = config('const.FREE_TAX');
            $task->price           = $request->price;
            $task->cases           = 1;
            $task->fee_format      = "固定";
            $task->save();
            \Log::info('タスク新規作成', ['user_id(company)' => $auth->id, 'task_id' => $task->id, 'status' => $task->status]);

            sendNotificationAssignedTask($task);

            return redirect()->route('company.task.show', ['id' => $task->id])->with('completed', '「'.$task->name.'」を作成しました。');

        // 新タスクとして登録
        } else{
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
    
            sendNotificationAssignedTask($task);

            return redirect()->route('company.task.show', ['id' => $task->id])->with('completed', '「'.$task->name.'」を作成しました。');
        }
    }

    public function show($id)
    {
        $task = Task::findOrFail($id);
        $purchaseOrder = PurchaseOrder::where('task_id', $id)->first();
        $invoice = Invoice::where('task_id', $id)->first();
        $auth = Auth::user();
        $company_users = CompanyUser::where('company_id', $auth->company_id)->get();
        if($task->deliver){
            $deliver = Deliver::where('task_id', $task->id)->first();
            $deliver_items = $deliver->deliverItems;
        }
        

        $company_user_ids = array();
        if ($task->companyUser) {
            array_push($company_user_ids, $task->companyUser->id);
        }

        $partners = Partner::where('company_id', $auth->company_id)->get();

        return view('/company/task/show', compact('auth', 'task', 'project_count', 'company_users', 'partners', 'purchaseOrder', 'invoice', 'company_user_ids', 'deliver', 'deliver_items'));
    }

    public function edit($id)
    {
        $auth = Auth::user();
        $task = Task::findOrFail($id);
        $projects = Project::where('company_id', $auth->company_id)->where('status', '!=', 1)->get();

        $companyUsers = CompanyUser::where('company_id', $auth->company_id)->get();
        $partners = Partner::where('company_id', $auth->company_id)->get();

        return view('company/task/edit', compact('task', 'projects','companyUsers', 'partners')); 
    }

    public function update(TaskPreviewRequest $request, $id)
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
