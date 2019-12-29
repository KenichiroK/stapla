<?php

namespace App\Http\Controllers\Partners;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $tasks = Task::where('partner_id', Auth::user()->id)
                                ->orderBy('created_at', 'desc')
                                ->get();

        $next_action_user_is_partner_status = [
            config('const.TASK_SUBMIT_PARTNER'),
            config('const.ORDER_SUBMIT_PARTNER'),
            config('const.WORKING'),
            config('const.ACCEPTANCE'),
            config('const.INVOICE_DRAFT_CREATE'),
            config('const.INVOICE_CREATE'),
        ];
    
        $todos = collect([])
                ->concat($tasks->whereIn('status', $next_action_user_is_partner_status))
                ->sortByDesc('status_updated_at');

        $passed_3days_todos = $todos->filter(function ($todo, $key) {
            return Carbon::now()->diffInDays(new Carbon($todo->status_updated_at)) > 3;
        })->sortByDesc('status_updated_at');

        $status_arr = [];
        for ($i = 0; $i <= 18; $i++) {
            $status_arr[strval($i)] = 0;
        }

        for ($i = 0; $i < $tasks->count(); $i++) {
            $status_arr[$tasks[$i]->status]++;
        }

        return view('partner/dashboard/index', compact(['projects', 'tasks', 'todos', 'passed_3days_todos', 'status_arr']));
    }
}
