<?php

namespace App\Http\Controllers\Companies;
 
use App\Http\Requests\Companies\CreateProjectRequest;
use App\Models\Project;
use App\Models\CompanyUser;
use App\Models\Partner;
use App\Models\ProjectCompany;
use App\Models\Task;

use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::where('company_id', Auth::user()->company_id)
                        ->where('status', '!=', config('consts.project.COMPLETED'))
                        ->orderBy('created_at', 'desc')
                        ->get();
        
        $project_status = config('consts.project.ALL');

        return view('company/project/index/index', compact('projects', 'project_status'));
    }

    public function doneIndex()
    {
        $projects = Project::where('company_id', Auth::user()->company_id)
                        ->where('status', config('consts.project.COMPLETED'))
                        ->orderBy('created_at', 'desc')
                        ->get();

        $project_status = config('consts.project.COMPLETED');

        return view('company/project/index/index', compact('projects', 'project_status'));
    }

    public function create()
    {
        $company_users = CompanyUser::where('company_id', Auth::user()->company_id)->get();        
        return view('company/project/create/index', compact('company_users'));
    }

    public function store(CreateProjectRequest $request)
    {   
        $time = date("Y_m_d_H_i_s");

        $company_user = Auth::user();

        $project = new Project;
        $project->company_id   = $company_user->company_id;
        $project->name         = $request->project_name;
        $project->detail       = $request->project_detail;
        $project->started_at   = date('Y-m-d', strtotime($request->started_at));
        $project->ended_at     = date('Y-m-d', strtotime($request->ended_at));
        $project->status       = 0;
        $project->budget       = $request->budget;
        $project->price        = 0;

        $project->save();
        \Log::info('プロジェクト新規作成', ['user_id' => $company_user->id, 'project_id' => $project->id, 'status' => $project->status]);

        $project_id = $project->id;
        
        $projectCompany = new ProjectCompany;
        $projectCompany->user_id = $request->company_user_id;
        $projectCompany->project_id = $project_id;
        $projectCompany->save();
        \Log::info('プロジェクト_カンパニー新規作成', ['user_id(company)' => $company_user->id, 'project_company_id' => $projectCompany->id]);

        return redirect()->route('company.project.show', ['id' => $project->id])->with('completed', '「'.$project->name.'」を作成しました。');
    }

    public function show($id)
    {
        $company_user = Auth::user();

        $project = Project::where('company_id', $company_user->company_id)->findOrFail($id);
        $tasks = Task::where('project_id',$project->id)->get();
        $activeTaskCount = $tasks->whereNotIn('status', [config("const.COMPLETE_STAFF"), config("const.TASK_CANCELED")])
                        ->count();

        return view('/company/project/show', compact('project','tasks', 'company_user', 'activeTaskCount'));
    }

    public function edit($project_id)
    {
        $company_user = Auth::user();
        $company_users = CompanyUser::where('company_id', $company_user->company_id)->get();
        $partner_users = Partner::where('company_id', $company_user->company_id)->get();
        $project = Project::findOrFail($project_id);
        
        return view('company/project/create', compact('company_user', 'company_users', 'project'));
    }

    public function update(CreateProjectRequest $request, $project_id)
    {
        $company_user = Auth::user();

        $project = Project::findOrFail($project_id);
        $project->company_id   = $company_user->company_id;
        $project->name         = $request->project_name;
        $project->detail       = $request->project_detail;
        $project->started_at   = date('Y-m-d', strtotime($request->started_at));
        $project->ended_at     = date('Y-m-d', strtotime($request->ended_at));
        $project->budget       = $request->budget;
        \Log::info('プロジェクト更新前', ['user_id' => $company_user->id, 'project_id' => $project->id, 'status' => $project->status]);

        $project->save();
        \Log::info('プロジェクト更新', ['user_id' => $company_user->id, 'project_id' => $project->id, 'status' => $project->status]);
        
        $projectCompany = ProjectCompany::where('project_id', $project->id)->update(['user_id' => $request->company_user_id ]);

       
        return redirect()->route('company.project.show', ['id' => $project->id])->with('completed', '「'.$project->name.'」を編集しました。');
    }

    public function complete($id, $status)
    {
        $auth = Auth::user();
        $project = Project::findOrFail($id);
        \Log::info('プロジェクトstatus変更前', ['user_id(company)' => $auth->id, 'project_id' => $project->id, 'status' => $project->status]);

        if($status == 0) {
            $project->status = config('consts.project.COMPLETED');
            \Log::info('プロジェクト完了', ['user_id(company)' => $auth->id, 'project_id' => $project->id, 'status' => $project->status]);
        } elseif($status == config('consts.project.COMPLETED')) {
            $project->status = config('consts.project.CREATED');
            \Log::info('プロジェクト再オープン', ['user_id(company)' => $auth->id, 'project_id' => $project->id, 'status' => $project->status]);
        }
        $project->save();
        return redirect()->route('company.project.index');
    }
}
