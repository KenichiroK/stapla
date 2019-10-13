<?php

namespace App\Http\Controllers\Partners;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Partner;
use App\Models\Project;
use App\Models\ProjectPartner;
use App\Models\TaskPartner;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function index()
    {
        $partner = Auth::user()->first();
        $partner_id = $partner->id;
        $projects = ProjectPartner::where('user_id', $partner_id)->get();
        $tasks = Task::where('partner_id', $partner_id)->get();

        return view('partner/dashboard/index', compact(['projects', 'tasks', 'partner']));
    }
}
