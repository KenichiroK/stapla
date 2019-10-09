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
        $partner_auth_id = Auth::user()->id;
        $partner_id = Partner::where('partner_id', $partner_auth_id)->get()->first()->id;
        $partner = Partner::where('partner_id', $partner_auth_id)->get()->first();
        $projects = ProjectPartner::where('user_id', $partner_id)->get();
        $tasks = Task::where('partner_id', $partner_id)->get();

        return view('partner/dashboard/index', compact(['projects', 'tasks', 'partner']));
    }
}
