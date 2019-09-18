<?php

namespace App\Http\Controllers\Companies;
 
use App\Http\Requests\Companies\CreateProjectRequest;
use App\Models\Project;
use App\Models\CompanyUser;
use App\Models\Partner;
use App\Models\ProjectCompany;
use App\Models\ProjectPartner;
use App\Models\ProjectSuperior;
use App\Models\ProjectAccounting;
use App\Models\Task;

use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $company_user = CompanyUser::where('auth_id', $user->id)->get()->first();
        $projects = Project::where('company_id', $company_user->company_id)->with(['company', 'tasks', 'projectRoleRelation', 'projectPartners.partner', 'projectCompanies.companyUser'])->get();        

        $task_count_arr = []; 
        for($i = 0; $i < count($projects); $i++){
            $taskCount = count($projects[$i]->tasks);
            array_push($task_count_arr, $taskCount);
        }
        return view('company/project/index', compact('projects', 'task_count_arr', 'company_user'));
    }

    public function doneIndex()
    {
        $user = Auth::user();
        $company_user = CompanyUser::where('auth_id', $user->id)->get()->first();
        $projects = Project::where('company_id', $company_user->company_id)->with(['company', 'tasks', 'projectRoleRelation', 'projectPartners.partner', 'projectCompanies.companyUser'])->get();        

        $task_count_arr = []; 
        for($i = 0; $i < count($projects); $i++){
            $taskCount = count($projects[$i]->tasks);
            array_push($task_count_arr, $taskCount);
        }
        return view('company/project/done-index', compact('projects', 'task_count_arr', 'company_user'));
    }

    public function create()
    {
        $user = Auth::user();
        $company_user = CompanyUser::where('auth_id', $user->id)->get()->first();

        $company_users = CompanyUser::where('company_id', $company_user->company_id)->get();

        $partner_users = Partner::where('company_id', $company_user->company_id)->get();
        
        return view('company/project/create', compact('company_users', 'partner_users', 'company_user'));
    }

    public function store(CreateProjectRequest $request)
    {   
        // return $request;
        $time = date("Y_m_d_H_i_s");

        $user = Auth::user();
        $company_id = CompanyUser::where('auth_id', $user->id)->get()->first()->company_id;

        $project = new Project;
        $project->company_id   = $company_id;
        $project->name         = $request->project_name;
        $project->detail       = $request->project_detail;
        $project->started_at   = date('Y-m-d', strtotime($request->started_at));
        $project->ended_at     = date('Y-m-d', strtotime($request->ended_at));
        $project->status       = 0;
        $project->budget       = $request->budget;
        $project->price        = 0;

        if($request->file){
            $file_name = $time.'_'.Auth::user()->id .'.'. $request->file->getClientOriginalExtension();
            $project->file = $file_name;
            $request->file('file')->storeAs('public/images/company/project/file' , $file_name);
        }
        $project->save();

        $project_id = $project->id;
        
        $projectCompany = new ProjectCompany;
        $projectCompany->user_id = $request->company_user_id;
        $projectCompany->project_id = $project_id;
        $projectCompany->save();

        $projectPartner = new ProjectPartner;
        $projectPartner->user_id = $request->partner_id;
        $projectPartner->project_id = $project_id;
        $projectPartner->save();

        $project_superior = new ProjectSuperior;
        $project_superior->project_id =  $project_id;
        $project_superior->user_id    =  $request->superior_id;
        $project_superior->save();

        $project_accounting = new ProjectAccounting;
        $project_accounting->project_id =  $project_id;
        $project_accounting->user_id    =  $request->accounting_id;
        $project_accounting->save();
        
        return redirect()->route('company.project.show', ['id' => $project->id])->with('completed', '「'.$project->name.'」を作成しました。');
    }

    public function show($id)
    {
        $user = Auth::user();
        $company_user = CompanyUser::where('auth_id', $user->id)->get()->first();

        $project = Project::where('company_id', $company_user->company_id)->findOrFail($id);
        $tasks = Task::where('project_id',$project->id)->get();
        
        return view('/company/project/show', compact('project','tasks', 'company_user'));
    }
}
