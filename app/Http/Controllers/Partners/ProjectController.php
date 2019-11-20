<?php

namespace App\Http\Controllers\Partners;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Partner;
use App\Models\Project;
use App\Models\Task;

class ProjectController extends Controller
{
    public function index()
    {
        $partner = Auth::user();
        $tasks = Task::where('partner_id', $partner->id)->get();
        $projectsAccordingTask;
        $projects = array();
        // $projects = Project::where('projects.company_id', $partner->company_id)
        //     ->where('projects.status', '!=', config('const.PROJECT_COMPLETE'))
        //     ->join('tasks', 'projects.id', '=', 'tasks.project_id')
        //     ->get();
        
        if ($tasks->count() === 0) {
            return view('partner/project/index', compact('projects'));
        }

        foreach ($tasks as $task) {
            $projectsAccordingTask[$task->project->id] = $task->project;
        }
        foreach ($projectsAccordingTask as $project) {
          array_push($projects, $project);
        }

        return view('partner/project/index', compact('projects'));
    }
    public function doneIndex()
    {
        $partner = Auth::user();
        $projects = Project::where('company_id', $partner->company_id)->where('status', config('const.PROJECT_COMPLETE'))->get();

        $task_count_arr = []; 
        for($i = 0; $i < count($projects); $i++){
            $taskCount = count($projects[$i]->tasks);
            array_push($task_count_arr, $taskCount);
        }
        return view('partner/project/done-index', compact('projects', 'task_count_arr'));
    }
    public function show($project_id)
    {
        $partner = Auth::user();
        $project = Project::findOrFail($project_id);
        $tasks = Task::where('project_id', $project->id)->where('partner_id', $partner->id)->get();

        return view('partner/project/show', compact('project', 'tasks'));
    }
}
