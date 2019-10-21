<?php

namespace App\Http\Controllers\Partners;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Partner;
use App\Models\Project;
use App\Models\TaskPartner;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function index()
    {
        $partner = Auth::user();
        $tasks = Task::where('partner_id', $partner->id)->get();
        $projectsAccordingTask;
        $projects = array();
        if ($tasks->count() === 0) {
            return view('partner/project/index', compact('partner', 'projects'));
        }

        foreach ($tasks as $task) {
            $projectsAccordingTask[$task->project->id] = $task->project;
        }
        foreach ($projectsAccordingTask as $project) {
          array_push($projects, $project);
        }

        return view('partner/dashboard/index', compact(['projects', 'tasks', 'partner']));
    }
}
