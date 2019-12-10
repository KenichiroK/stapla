<?php

namespace App\Http\Controllers\Companies;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProjectCompany;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $projects = ProjectCompany::where('user_id', Auth::user()->id)
                                ->join('projects', 'project_companies.project_id', '=', 'projects.id')
                                ->orderBy('projects.created_at', 'desc')
                                ->get();        

        $tasks = Task::where('company_user_id', Auth::user()->id)
                                ->orWhere('superior_id', Auth::user()->id)
                                ->orWhere('accounting_id', Auth::user()->id)
                                ->orderBy('created_at', 'desc')
                                ->get();

        $company_user_tasks = Task::where('company_user_id', Auth::user()->id)->get();
        $superior_tasks     = Task::where('superior_id', Auth::user()->id)->get();
        $accounting_tasks   = Task::where('accounting_id', Auth::user()->id)->get();

        $next_action_user_is_company_user_status = [
            config('const.TASK_APPROVAL_SUPERIOR'),
            config('const.TASK_APPROVAL_PARTNER'),
            config('const.ORDER_APPROVAL_SUPERIOR'),
            config('const.DELIVERY_PARTNER'),
            config('const.SUBMIT_STAFF'),
            config('const.APPROVAL_ACCOUNTING'),
        ];

        $next_action_user_is_superior_status  = [
            config('const.TASK_SUBMIT_SUPERIOR'),
            config('const.ORDER_SUBMIT_SUPERIOR'),
        ];

        $next_action_user_is_accounting_status  = [
            config('const.SUBMIT_ACCOUNTING'),
        ];

        $todos = [];

        foreach($company_user_tasks as $company_user_task) {
            if (in_array($company_user_task->status, $next_action_user_is_company_user_status)) {
                array_push($todos, $company_user_task);
            }
        }
        

        foreach($superior_tasks as $superior_task) {
            if (in_array($superior_task->status, $next_action_user_is_superior_status)) {
                array_push($todos, $superior_task);
            }
        }

        foreach($accounting_tasks as $accounting_task) {
            if (in_array($accounting_task->status, $next_action_user_is_accounting_status)) {
                array_push($todos, $accounting_task);
            }
        }

        $after_three_days_todos = [];

        if (count($todos) !== 0) {
            foreach($todos as $todo) {
                if (Carbon::now()->diffInDays(new Carbon($todo->status_udpated_at)) > 3) {
                    array_push($after_three_days_todos, $todo);
                }
            }
        }
        

        $status_arr = [];
        for ($i = 0; $i <= 18; $i++) {
            $status_arr[strval($i)] = 0;
        }

        for ($i = 0; $i < $tasks->count(); $i++) {
            $status_arr[$tasks[$i]->status]++;
        }

        return view('company/dashboard/index', compact('projects', 'tasks', 'todos', 'after_three_days_todos', 'status_arr'));
    }
}
