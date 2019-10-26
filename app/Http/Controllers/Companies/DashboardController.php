<?php

namespace App\Http\Controllers\Companies;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectCompany;
use App\Models\Company;
use App\Models\CompanyUser;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;


class DashboardController extends Controller
{
    public function index()
    {
        $companyUser = Auth::user();
        $companyUser_id = $companyUser->id;
        $company_id = $companyUser->company_id;
        // $projects = ProjectCompany::where('user_id', $companyUser_id)->get();
        $projects = ProjectCompany::where('user_id', $companyUser_id)
                                ->join('projects', 'project_companies.project_id', '=', 'projects.id')
                                ->whereNotIn('status', [config('const.PROJECT_COMPLETE'), config('const.PROJECT_CANCELED')])
                                ->get();


        $tasks = Task::where('company_user_id', $companyUser_id)
                                ->whereNotIn('status', [config('const.COMPLETE_STAFF'), config('const.TASK_CANCELED')])
                                ->orWhere('superior_id', $companyUser_id)
                                ->whereNotIn('status', [config('const.COMPLETE_STAFF'), config('const.TASK_CANCELED')])
                                ->orWhere('accounting_id', $companyUser_id)
                                ->whereNotIn('status', [config('const.COMPLETE_STAFF'), config('const.TASK_CANCELED')])
                                ->get();

        $status_arr = [];
        for ($i = 0; $i <= 18; $i++) {
            $status_arr[strval($i)] = 0;
        }

        for ($i = 0; $i < $tasks->count(); $i++) {
            $status_arr[$tasks[$i]->status]++;
        }
        
        // タスクステータスを外部ファイルで定数化（congfig/const.php）
        $statusName_arr = Config::get('const.TASK_STATUS_LIST');
        
        return view('company/dashboard/index', compact('projects', 'tasks', 'status_arr', 'statusName_arr'));
    }
}