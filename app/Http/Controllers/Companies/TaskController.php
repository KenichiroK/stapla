<?php

namespace App\Http\Controllers\Companies;

use App\Models\Task;
use App\Models\Project;
use App\Models\Partner;
use App\Models\CompanyUser;
use App\Models\TaskCompany;
use App\Models\TaskPartner;
use App\Models\PurchaseOrder;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $company_user = CompanyUser::where('auth_id', $user->id)->get()->first();
        $tasks = Task::where('company_id', $company_user->company_id)->with(['project', 'taskCompanies.companyUser', 'taskPartners.partner', 'taskRoleRelation'])->get();
            
        $status_arr = [];
        for ($i = 0; $i < 15; $i++) {
            $status_arr[strval($i)] = 0;
        }
        for ($i = 0; $i < $tasks->count(); $i++) {
            $status_arr[$tasks[$i]->status]++;
        }

        $statusName_arr = [
            '下書き', 'タスク上長確認前', 'タスク上長確認中', 'タスクパートナー依頼前', 'タスクパートナー依頼中', '発注書作成中', '発注書作成完了', '発注書上長確認中', 
            '発注書パートナー依頼前', '発注書パートナー確認中', '作業中', '請求書依頼中', '請求書確認中', '完了', 'キャンセル', 
        ];

        return view('company/task/index', compact('tasks','statusName_arr', 'status_arr', 'company_user'));
    }

    public function projectTaskIndex($project_uid)
    {
        return Task::where('project_id', $project_uid)->get();
    }

    public function create()
    {
        $user = Auth::user();
        $company_user = CompanyUser::where('auth_id', $user->id)->get()->first();
        $projects = Project::where('company_id', $company_user->company_id)->get();
       
        
        $companyUsers = CompanyUser::where('company_id', $company_user->company_id)->get();
        $partners = Partner::where('company_id', $company_user->company_id)->get();
        return view('company/task/create', compact('projects','companyUsers', 'partners', 'company_user'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'company_user_id' => 'required',
            'project_id'      => 'required',
            'partner_id'      => 'required',
            'superior_id'     => 'required',
            'accounting_id'   => 'required',
            'task_name'       => 'required',
            'task_content'    => 'required',
            'price'           => 'required',
            'fee_format'      => 'required',
        ]);

        
        $task = new Task;
        $task->project_id      = $request->project_id;
        $user = Auth::user();
        $company_id = CompanyUser::where('auth_id', $user->id)->get()->first()->company_id;
        $task->company_id      = $company_id;
        $task->superior_id     = $request->superior_id;
        $task->accounting_id   = $request->accounting_id;
        $task->partner_id      = $request->partner_id;
        $task->name            = $request->task_name;
        $task->content         = $request->task_content;
        $task->started_at      = '2019-06-27 12:00:00';
        $task->ended_at        = '2019-06-30 12:00:00';
        $task->status          = 1;
        $task->purchaseorder   = false;
        $task->invoice         = false;
        $task->budget          = 100000;
        $task->tax             = 0.08;
        $task->price           = $request->price;
        $task->comment         = $request->comment;
        $task->inspection_date = $request->inspection_date;
        $task->fee_format      = $request->fee_format;
        $task->delivery_format = $request->delivery_format;
        $task->payment_terms   = $request->payment_terms;
        $task->rating          = $request->rating;
        $task->save();

        $taskCompany = new TaskCompany;
        $taskCompany->user_id = $request->company_user_id;
        $task_id = $task->id;
        $taskCompany->task_id = $task_id;
        $taskCompany->save();

        return redirect('/company/task');
    }

    public function show($id)
    {
        $task = Task::findOrFail($id);
        $purchaseOrder = PurchaseOrder::where('task_id', $id)->first();
        $invoice = Invoice::where('task_id', $id)->first();
        $user = Auth::user();
        $company_user = CompanyUser::where('auth_id', $user->id)->get()->first();
        $companyUsers = CompanyUser::where('company_id', $company_user->company_id)->get();

        $partners = Partner::where('company_id', $company_user->company_id)->get();

        return view('/company/task/show', compact('task', 'project_count', 'companyUsers', 'partners', 'company_user', 'purchaseOrder', 'invoice'));
    }

    public function edit($id)
    {
        return Task::with(['project', 'taskCompanyPics.companyUser', 'taskPartnerPics.partner'])->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        Task::findOrFail($id)->update($request->all());
        return Task::with(['project', 'taskCompanyPics.companyUser', 'taskPartnerPics.partner'])->get();
    }
    
    public function destroy($id)
    {
        Task::findOrFail($id)->delete();
        return Task::with(['project', 'taskCompanyPics.companyUser', 'taskPartnerPics.partner'])->get();
    }
}
