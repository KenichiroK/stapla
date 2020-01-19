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

        $tasks = Task::whereNotIn('status', [config('const.COMPLETE_STAFF'), config('const.TASK_CANCELED')])
                                ->where(function($query){
                                    $query->where('company_user_id', Auth::user()->id)
                                            ->orWhere('superior_id', Auth::user()->id)
                                            ->orWhere('accounting_id', Auth::user()->id);
                                })
                                ->orderBy('created_at', 'desc')
                                ->get();

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

        $todos = collect([])
                ->concat($tasks->where('company_user_id', Auth::user()->id)->whereIn('status', $next_action_user_is_company_user_status))
                ->concat($tasks->where('superior_id', Auth::user()->id)->whereIn('status', $next_action_user_is_superior_status))
                ->concat($tasks->where('accounting_id', Auth::user()->id)->whereIn('status', $next_action_user_is_accounting_status))
                ->sortByDesc('status_updated_at');

        $passed_3days_todos = $todos->filter(function ($value, $key) {
            return Carbon::now()->diffInDays(new Carbon($value->status_updated_at)) > 3;
        })->sortByDesc('status_updated_at');

        $status_arr = [];

        foreach (config('const.TASK_STATUS_ARR') as $key => $TASK_STATUS) {
            $status_arr[$key] = $tasks->where('status', config('const')[$TASK_STATUS])->count();
        }

        return view('company/dashboard/index', compact('projects', 'tasks', 'todos', 'passed_3days_todos', 'status_arr'));
    }
}
