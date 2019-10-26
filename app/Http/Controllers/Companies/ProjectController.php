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
        $companyUser = Auth::user();
        $projects = Project::where('company_id', $companyUser->company_id)->where('status', '!=', config('const.COMPLETE_STAFF'))->get();        

        $task_count_arr = []; 
        for($i = 0; $i < count($projects); $i++){
            $taskCount = count($projects[$i]->tasks);
            array_push($task_count_arr, $taskCount);
        }
        return view('company/project/index', compact('projects', 'task_count_arr'));
    }

    public function doneIndex()
    {
        $companyUser = Auth::user();
        $projects = Project::where('company_id', $companyUser->company_id)->where('status', config('const.COMPLETE_STAFF'))->get();

        $task_count_arr = []; 
        for($i = 0; $i < count($projects); $i++){
            $taskCount = count($projects[$i]->tasks);
            array_push($task_count_arr, $taskCount);
        }
        return view('company/project/done-index', compact('projects', 'task_count_arr', 'company_user'));
    }

    public function create()
    {
        $companyUser = Auth::user();

        $companyUsers = CompanyUser::where('company_id', $companyUser->company_id)->get();

        $partnerUsers = Partner::where('company_id', $companyUser->company_id)->get();
        
        return view('company/project/create', compact('companyUser', 'companyUsers'));
    }

    public function store(CreateProjectRequest $request)
    {   
        $time = date("Y_m_d_H_i_s");

        $company_id = Auth::user()->company_id;

        $project = new Project;
        $project->company_id   = $company_id;
        $project->name         = $request->project_name;
        $project->detail       = $request->project_detail;
        $project->started_at   = date('Y-m-d', strtotime($request->started_at));
        $project->ended_at     = date('Y-m-d', strtotime($request->ended_at));
        $project->status       = 0;
        $project->budget       = $request->budget;
        $project->price        = 0;

        // if($request->file) {
        //     $picture              = $request->file;
        //     $path_picture         = \Storage::disk('s3')->putFileAs($user->id, $picture,$time.'_'.$auth->id .'.'. $picture->getClientOriginalExtension(), 'public');
        //     $companyUser->picture = \Storage::disk('s3')->url($path_picture);
        //     $companyUser->save();
        // }
        $project->save();

        $project_id = $project->id;
        
        $projectCompany = new ProjectCompany;
        $projectCompany->user_id = $request->company_user_id;
        $projectCompany->project_id = $project_id;
        $projectCompany->save();
        
        return redirect()->route('company.project.show', ['id' => $project->id])->with('completed', '「'.$project->name.'」を作成しました。');
    }

    public function show($id)
    {
        $companyUser = Auth::user();

        $project = Project::where('company_id', $companyUser->company_id)->findOrFail($id);
        $tasks = Task::where('project_id',$project->id)->get();
        
        return view('/company/project/show', compact('project','tasks', 'companyUser'));
    }

    public function complete($id, $status)
    {
        if($status == 0) {
            $project = Project::findOrFail($id);
            $project->status = config('const.PROJECT_COMPLETE');
            $project->save();
        } elseif($status == config('const.PROJECT_COMPLETE')) {
            $project = Project::findOrFail($id);
            $project->status = config('const.PROJECT_CREATE');
            $project->save();
        }
        return redirect()->route('company.project.index');
    }
}
