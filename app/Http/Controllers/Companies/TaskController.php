<?php

namespace App\Http\Controllers\Companies;

use App\Http\Controllers\Controller;
use App\Http\Requests\Companies\TaskDraftRequest;
use App\Http\Requests\Companies\TaskPreviewRequest;
use App\Http\Requests\Companies\TaskUpdateDraftRequest;
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
        $all_tasks = Task::where('company_id', Auth::user()->company_id)
                        ->orderBy('created_at', 'desc')
                        ->get();

        $tasks = $all_tasks->whereNotIn('status', [config('const.COMPLETE_STAFF'), config('const.TASK_CANCELED')]);

        $status_arr = [];
        foreach (config('const.TASK_STATUS_ARR') as $key => $TASK_STATUS) {
            $status_arr[$key] = $all_tasks->where('status', config('const')[$TASK_STATUS])->count();
        }
        $shown_task_status = null;

        return view('company/task/index/index', compact('tasks', 'status_arr', 'shown_task_status'));
    }

    public function statusIndex($task_status)
    {
        $tasks = Task::where('company_id', Auth::user()->company_id)
                        ->where('status', $task_status)
                        ->orderBy('created_at', 'desc')
                        ->get();

        $status_arr = [];
        $all_tasks = Task::where('company_id', Auth::user()->company_id)->get();

        foreach (config('const.TASK_STATUS_ARR') as $key => $TASK_STATUS) {
            $status_arr[$key] = $all_tasks->where('status', config('const')[$TASK_STATUS])->count();
        }

        $shown_task_status = (integer)$task_status;

        return view('company/task/index/index', compact('tasks', 'status_arr', 'shown_task_status'));
    }

    public function projectTaskIndex($project_uid)
    {
        return Task::where('project_id', $project_uid)->get();
    }

    // タスク・発注書 作成
    public function create(Request $request)
    {
        $auth = Auth::user();
        $company_users = CompanyUser::where('company_id', $auth->company_id)->get();
        $partners = Partner::where('company_id', $auth->company_id)->get();
        $projects = Project::where('company_id', $auth->company_id)->where('status', '!=', config('consts.project.COMPLETED'))->get();

        if($request->query('pid')){
            $project_id = $request->query('pid');
            $quoted_project = Project::where('id', $project_id)->first();
            return view('company/task/create/index', compact('projects', 'quoted_project', 'company_users', 'partners', 'company_user', 'task'));
        } else{
            return view('company/task/create/index', compact('projects', 'company_users', 'partners', 'company_user', 'task'));
        }
    }

    // 下書き状態タスクの作成ページ
    public function createDraft($task_id)
    {
        // タスク
        $task = Task::findOrFail($task_id);
        $company_user = Auth::user();
        $projects = Project::where('company_id', $company_user->company_id)->where('status', '!=', config('consts.project.COMPLETED'))->get();
        $company_users = CompanyUser::where('company_id', $company_user->company_id)->get();
        $partners = Partner::where('company_id', $company_user->company_id)->get();
        // 発注書
        $purchaseOrder = PurchaseOrder::where('task_id', $task->id)->first();

        return view('company/task/create/index', compact('projects', 'company_users', 'partners', 'task', 'purchaseOrder'));
    }

    // 下書きとして保存
    public function draft(TaskDraftRequest $request)
    {
        $auth = Auth::user();
        if(isset($request->task_id)){
            // NOTE: タスク・発注書が下書きとしてすでに保存してある場合
            $task = Task::findOrFail($request->task_id);
            $purchaseOrder = PurchaseOrder::where('task_id', $task->id)->firstOrFail();
        } else{
            // NOTE: タスク・発注書を新規作成する場合
            $task = new Task;
            $purchaseOrder = new PurchaseOrder;
        }
        // タスク下書き
        $task->company_id        = $auth->company_id;
        $task->project_id        = $request->project_id;
        $task->name              = $request->task_name;
        $task->started_at        = Carbon::createFromTimestamp(strtotime($request->started_at))
                                  ->format('Y-m-d-H-i-s');
        $task->ended_at          = Carbon::createFromTimestamp(strtotime($request->ended_at))
                                  ->format('Y-m-d-H-i-s');
        $task->status            = config('const.TASK_CREATE');
        $task->purchaseorder     = false;
        $task->invoice           = false;
        $task->tax               = config('const.FREE_TAX');
        $task->status_updated_at = Carbon::now();
        $task->delivery_date     = Carbon::createFromTimestamp(strtotime($request->delivery_date))
                                    ->format('Y-m-d-H-i-s');
        // nullable()の可能性がある項目
        $task->company_user_id = $request->task_company_user_id ?? null;
        $task->superior_id     = $request->superior_id ?? null;
        $task->accounting_id   = $request->accounting_id ?? null;
        $task->partner_id      = $request->partner_id ?? null;
        $task->content         = $request->content ?? null;
        $task->partner_id      = $request->partner_id ?? null;
        $task->price           = $request->order_price ?? null;

        $task->save();

        // 発注書下書き
        $purchaseOrder->company_id         = $auth->company_id;
        $purchaseOrder->task_id            = $task->id;
        $purchaseOrder->status             = config('consts.order.DRAFT');
        $purchaseOrder->ordered_at         = $request->order_at;
        $purchaseOrder->company_name       = $auth->company->company_name;
        $purchaseOrder->company_tel        = $auth->company->tel;
        $purchaseOrder->company_zip_code   = $auth->company->zip_code;
        $purchaseOrder->company_prefecture = $auth->company->address_prefecture;
        $purchaseOrder->company_city       = $auth->company->address_city;
        $purchaseOrder->company_building   = $auth->company->address_building;
        $purchaseOrder->task_ended_at      = $request->ended_at;
        $purchaseOrder->task_tax           = $task->tax;
        // nullable()の可能性がある項目
        if(isset($request->partner_id)){
            $purchaseOrder->partner_id   = $request->partner_id;
            $purchaseOrder->partner_name = Partner::findOrFail($request->partner_id)->name;
        }
        if(isset($request->task_company_user_id)){
            $purchaseOrder->companyUser_id = $request->task_company_user_id;
        }
        if(isset($request->order_name)){
            $purchaseOrder->task_name = $request->order_name;
        } else{
            $purchaseOrder->task_name = $task->name;
        }
        if(isset($request->order_company_user)){
            $purchaseOrder->companyUser_name = $request->order_company_user;
        } else{
            if(isset($request->task_company_user_id)){
                $purchaseOrder->companyUser_name = CompanyUser::findOrFail($request->task_company_user_id)->name;
            }
        }
        if(isset($request->order_price)){
            $purchaseOrder->task_price = $request->order_price;
        }
        $purchaseOrder->save();

        return redirect()->route('company.task.createDraft' ,['task_id' => $task->id])
                                ->withInput($request->all())
                                ->with('completed', '「'.$task->name.'」を下書きとして保存しました。');
    }

    // タスクプレビュー
    public function taskPreview(TaskPreviewRequest $request)
    {
        // 下書きとして保存されているタスク
        if(isset($request->task_id)){
            $task = Task::findOrFail($request->task_id);
            $task_status = config('const.TASK_CREATE');
        }
        $project           = Project::findOrFail($request->project_id);
        $task_company_user = CompanyUser::findOrFail($request->task_company_user_id);
        $superior_user     = CompanyUser::findOrFail($request->superior_id);
        $accounting_user   = CompanyUser::findOrFail($request->accounting_id);
        $partner = Partner::findORFail($request->partner_id);
        // 発注書
        $order_name        = $request->order_name;
        if(isset($request->order_company_user)){
            $order_company_user = $request->order_company_user;
        } else{
            $order_company_user = $task_company_user->name;
        }

        if(isset($request->task_id)){
            return view('company.task.preview.show', compact('request', 'task_company_user', 'project', 'superior_user', 'accounting_user', 'partner', 'task', 'task_status', 'order_name', 'order_company_user'));
        } else{
            return view('company.task.preview.show', compact('request', 'task_company_user', 'project', 'superior_user', 'accounting_user', 'partner', 'order_company_user'));
        }
    }

    // 発注書プレビュー
    public function purchaseOrderPreview(Request $request)
    {
        $task_company_user   = CompanyUser::findOrFail($request->task_company_user_id);
        $superior_user       = CompanyUser::findOrFail($request->superior_id);
        $ordered_at          = date("Y-m-d");
        $partner             = Partner::findORFail($request->partner_id);
        $order_name          = $request->order_name;
        $delivery_date       = Carbon::createFromTimestamp(strtotime($request->delivery_date))
                                ->format('Y-m-d-H-i-s');
        $order_company_user = $request->order_company_user;
        if(isset($request->task_id)){
            $task_id = $request->task_id;
            return view('company.document.purchaseOrder.preview.show', compact('request', 'task_company_user', 'superior_user', 'ordered_at', 'partner', 'order_name', 'delivery_date', 'order_company_user', 'task_id'));
        }
        return view('company.document.purchaseOrder.preview.show', compact('request', 'task_company_user', 'superior_user', 'ordered_at', 'partner', 'order_name', 'delivery_date', 'order_company_user'));
    }

    // 再編集
    public function reCreate(Request $request)
    {
        if($request->task_id){
            $task = Task::findOrFail($request->task_id);
            return redirect()->route('company.task.createDraft' ,['task_id' => $task->id])
                                ->withInput($request->all());
        } else{
            return redirect()->route('company.task.create')
                                ->withInput($request->all());
        }
    }

    // 保存
    public function store(Request $request)
    {
        $auth = Auth::user();
        if(isset($request->task_id)){
            // NOTE: タスク・発注書が下書きとしてすでに保存してある場合
            $task = Task::findOrFail($request->task_id);
            $purchaseOrder = PurchaseOrder::where('task_id', $request->task_id)->firstOrFail();
        } else{
            // NOTE: タスク・発注書を新規作成する場合
            $task = new Task;
            $purchaseOrder = new PurchaseOrder;
        }
        // タスク
        $task->company_id        = $auth->company_id;
        $task->project_id        = $request->project_id;
        $task->company_user_id   = $request->task_company_user_id;
        $task->superior_id       = $request->superior_id;
        $task->accounting_id     = $request->accounting_id;
        $task->partner_id        = $request->partner_id;
        $task->name              = $request->task_name;
        $task->content           = $request->content;
        $task->started_at        = Carbon::createFromTimestamp(strtotime($request->started_at))->format('Y-m-d-H-i-s');
        $task->ended_at          = Carbon::createFromTimestamp(strtotime($request->ended_at))->format('Y-m-d-H-i-s');
        $task->status            = config('const.TASK_SUBMIT_SUPERIOR');
        $task->purchaseorder     = false;
        $task->invoice           = false;
        $task->tax               = config('const.TEN_TAX');
        $task->price             = $request->order_price;
        $task->delivery_date = Carbon::createFromTimestamp(strtotime($request->delivery_date))
                                ->format('Y-m-d-H-i-s');  
        $task->status_updated_at = Carbon::now();
        $task->save();

        // 発注書登録
        $purchaseOrder->company_id           = $auth->company_id;
        $purchaseOrder->partner_id           = $request->partner_id;
        $purchaseOrder->task_id              = $task->id;
        $purchaseOrder->status               = config('consts.order.CREATED');
        $purchaseOrder->ordered_at           = $request->order_at;
        $purchaseOrder->company_name         = $auth->company->company_name;
        $purchaseOrder->company_tel          = $auth->company->tel;
        $purchaseOrder->company_zip_code     = $auth->company->zip_code;
        $purchaseOrder->company_prefecture   = $auth->company->address_prefecture;
        $purchaseOrder->company_city         = $auth->company->address_city;
        $purchaseOrder->company_building     = $auth->company->address_building;
        $purchaseOrder->companyUser_name     = $request->order_company_user;
        $purchaseOrder->partner_name         = Partner::findOrFail($request->partner_id)->name;
        $task = Task::findOrFail($task->id);
        if(isset($request->order_name)){
            $purchaseOrder->task_name = $request->order_name;
        } else{
            $purchaseOrder->task_name         = $task->name;
        }
        $purchaseOrder->task_ended_at        = $request->ended_at;
        $purchaseOrder->task_price           = $request->order_price;
        $purchaseOrder->task_tax             = $task->tax;
        $purchaseOrder->save();
        
        \Log::info('タスク・発注書 新規作成', ['user_id(company)' => $auth->id, 'task_id' => $task->id, 'status' => $task->status, 'purchase_order_id' => $purchaseOrder->id]);
        sendNotificationAssignedTask($task);

        return redirect()->route('company.task.show', ['id' => $task->id])->with('completed', '「'.$task->name.'」を作成しました。');
    }

    public function show($task_id)
    {
        $task = Task::findOrFail($task_id);
        $purchaseOrder = PurchaseOrder::where('task_id', $task_id)->first();
        $invoice = Invoice::where('task_id', $task_id)->first();
        
        if($task->deliver){
            $deliver = Deliver::where('task_id', $task->id)->first();
            $deliver_items = $deliver->deliverItems;
        }

        $company_user_ids = array();
        if ($task->companyUser) {
            array_push($company_user_ids, $task->companyUser->id);
        }

        $alert_next_action_user = null;

        if ($task->company_user_id === Auth::user()->id && in_array(config('const.TASK_STATUS_ARR')[$task->status], config('consts.taskNextAction.ASK_TO_SUPERIOR_FROM_COMPANY_USER'))) {
            $alert_next_action_user = '上長に承認依頼';
        }

        if ($task->company_user_id === Auth::user()->id && in_array(config('const.TASK_STATUS_ARR')[$task->status], config('consts.taskNextAction.ASK_TO_ACCOUNTING_FROM_COMPANY_USER'))) {
            $alert_next_action_user = '経理に承認依頼';
        }

        if ($task->company_user_id === Auth::user()->id && ($task->status === config('const.DELIVERY_PARTNER'))) {
            $alert_next_action_user = '検収';
        }

        if ($task->company_user_id === Auth::user()->id && ($task->status === config('const.APPROVAL_ACCOUNTING'))) {
            $alert_next_action_user = 'タスクを完了';
        }

        if ($task->company_user_id === Auth::user()->id && in_array(config('const.TASK_STATUS_ARR')[$task->status], config('consts.taskNextAction.ASK_TO_PARTNER_FROM_COMPANY_USER'))) {
            $alert_next_action_user = 'パートナーに確認依頼';
        }

        if ($task->superior_id === Auth::user()->id && in_array(config('const.TASK_STATUS_ARR')[$task->status], config('consts.taskNextAction.APPROVED_SUPERIOR'))) {
            $alert_next_action_user = '上長承認';
        }

        if ($task->accounting_id === Auth::user()->id && in_array(config('const.TASK_STATUS_ARR')[$task->status], config('consts.taskNextAction.APPROVED_ACCOUNTING'))) {
            $alert_next_action_user = '経理承認';
        }

        return view('/company/task/show/index', compact('task', 'alert_next_action_user', 'purchaseOrder', 'invoice', 'company_user_ids', 'deliver'));
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
