<?php

namespace App\Http\Controllers\Companies;

use App\Models\Task;
use App\Models\Partner;
use App\Models\CompanyUser;
use App\Models\TaskCompany;
use App\Models\TaskPartner;
use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $company_id = CompanyUser::where('auth_id', $user->id)->get()->first()->company_id;
        $tasks = Task::where('company_id', $company_id)->with(['project', 'taskCompanies.companyUser', 'taskPartners.partner', 'taskRoleRelation'])->get();
            
        $status_arr = [];
        for ($i = 0; $i < 11; $i++) {
            $status_arr[strval($i)] = 0;
        }
        for ($i = 0; $i < $tasks->count(); $i++) {
            $status_arr[$tasks[$i]->status]++;
        }

        $statusName_arr = [
            '下書き', '提案中', '依頼前', '依頼中', '開始前','作業中', '提出前', '修正中', '完了', 'キャンセル'
        ];

        return view('company/task/index', compact('tasks','statusName_arr', 'status_arr'));
    }

    public function projectTaskIndex($project_uid)
    {
        return Task::where('project_id', $project_uid)->get();
    }

    public function create()
    {
        $user = Auth::user();
        $company_id = CompanyUser::where('auth_id', $user->id)->get()->first()->company_id;
        $tasks = Task::where('company_id', $company_id)->with(['project', 'taskCompanies.companyUser', 'taskPartners.partner', 'taskRoleRelation'])->get();
       
        
        $companyUsers = CompanyUser::where('company_id', $company_id)->get();
        $partners = Partner::where('company_id', $company_id)->get();
        return view('company/task/create', compact('tasks','companyUsers', 'partners'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'company_user_id' => 'required',
            'project_id'      => 'required',
            'partner_id'      => 'required',
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
        $task->name            = $request->task_name;
        $task->content         = $request->task_content;
        $task->started_at      = '2019-06-27 12:00:00';
        $task->ended_at        = '2019-06-30 12:00:00';
        $task->status          = 0;
        $task->purchaseorder   = false;
        $task->invoice         = false;
        $task->budget          = 100000;
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

        $taskPartner = new TaskPartner;
        $taskPartner->user_id = $request->partner_id;
        $taskPartner->task_id = $task_id;
        $taskPartner->save();

        return redirect('/company/task');
    }

    public function show($id)
    {
        // task
        $tasks = Task::with(['project', 'taskCompanies.companyUser', 'taskPartners.partner'])->findOrFail($id);
        // CompanyUesr
        $user_id = TaskCompany::where('task_id', $id)->get()->first()->user_id;
        $taskCompanyUsers = CompanyUser::where('id', $user_id)->get();
        // 同一 project の task 数
        $project_id = Task::where('id', $id)->get()->first()->project_id;
        $project_count = Task::where('project_id', $project_id)->get()->count();
        // Project::where('')->count()
        // CompanyUser一覧
        $user = Auth::user();
        $company_id = CompanyUser::where('auth_id', $user->id)->get()->first()->company_id;
        $companyUsers = CompanyUser::where('company_id', $company_id)->get();
        // Partnerの一覧
        $partners = Partner::where('company_id', $company_id)->get();
        return view('/company/task/show', compact('tasks', 'taskCompanyUsers', 'project_count', 'companyUsers', 'partners'));
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
