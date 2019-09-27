<?php

namespace App\Http\Controllers\Partners;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Partner;
use App\Models\Project;
use App\Models\Task;
use App\Models\ProjectPartner;

class ProjectController extends Controller
{
    public function index()
    {
        $partnerAuth = Auth::user();
        $partner = Partner::where('partner_id', $partnerAuth->id)->first();
        $projectPartners = ProjectPartner::where('user_id', $partner->id)->get();
        // return $companyProjects = Project::where('company_id', $partner->company_id)->get();
        foreach ($projectPartners as $projectPartner) {
            $projects = Project::where('id', $projectPartner->project_id)->get();
        }

        $task_count_arr = []; 
        for($i = 0; $i < count($projects); $i++){
            $taskCount = count($projects[$i]->tasks);
            array_push($task_count_arr, $taskCount);
        }
        return view('partner/project/index', compact('partner', 'projects', 'task_count_arr'));
    }
    public function show($project_id)
    {
        $partnerAuth = Auth::user();
        $partner = Partner::where('partner_id', $partnerAuth->id)->first();
        $project = Project::findOrFail($project_id);
        $tasks = Task::where('project_id', $project->id)->where('partner_id', $partner->id)->get();

        return view('partner/project/show', compact('partner', 'project', 'tasks'));
    }
}
