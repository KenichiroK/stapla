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


class DashboardController extends Controller
{
    public function index()
    {
        $companyUser = Auth::user();
        $companyUser_id = $companyUser->id;
        $company_id = $companyUser->company_id;
        $projects = ProjectCompany::where('user_id', $companyUser_id)->get();
        $tasks = Task::where('company_user_id', $companyUser_id)
                                ->whereNotIn('status', [17, 18])
                                ->orWhere('superior_id', $companyUser_id)
                                ->whereNotIn('status', [17, 18])
                                ->orWhere('accounting_id', $companyUser_id)
                                ->whereNotIn('status', [17, 18])
                                ->get();

        $status_arr = [];
        for ($i = 0; $i <= 18; $i++) {
            $status_arr[strval($i)] = 0;
        }

        for ($i = 0; $i < $tasks->count(); $i++) {
            $status_arr[$tasks[$i]->status]++;
        }
        $statusName_arr = [
            // タスク
            'タスク下書き',
            'タスク上長確認中',
            'タスクパートナー依頼前',
            'タスクパートナー確認中',
            '発注書作成前',
            // 発注書
            '発注書上長確認中',
            '発注書パートナー依頼前',
            '発注書パートナー確認中',
            '作業前',
            // 作業中
            '作業中',
            '検品中',
            '請求書作成前',
            // 請求書
            '請求書下書き',
            '請求書担当者確認前',
            '担当者確認中',
            '経理確認中',
            '経理承認済',
            // その他
            '完了',
            'キャンセル', 
        ];
        
        return view('company/dashboard/index', compact('projects', 'tasks', 'status_arr', 'statusName_arr'));
    }
}