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
        $tasks = Task::where('partner_id', $partner->id)
                                ->whereNotIn('status', [17, 18])
                                ->get();

        $projectsAccordingTask;
        $projects = array();
     
        if ($tasks->count() !== 0) {
            foreach ($tasks as $task) {
                $projectsAccordingTask[$task->project->id] = $task->project;
            }
            foreach ($projectsAccordingTask as $project) {
                array_push($projects, $project);
            }
        }

        // dd(config('const.TASK_STATUS_LIST'));

        return view('partner/dashboard/index', compact(['projects', 'tasks', 'partner']));
    }
}
