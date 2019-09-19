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
    public function show($project_id)
    {
        $partnerAuth = Auth::user();
        $partner = Partner::where('partner_id', $partnerAuth->id)->first();
        $project = Project::findOrFail($project_id);
        $tasks = Task::where('project_id', $project->id)->where('partner_id', $partner->id)->get();

        return view('partner/project/show', compact('partner', 'project', 'tasks'));
    }
}
