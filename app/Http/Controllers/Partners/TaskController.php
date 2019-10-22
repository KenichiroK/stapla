<?php

namespace App\Http\Controllers\Partners;

use App\Models\Task;
use App\Models\Partner;
use App\Models\CompanyUser;
use App\Models\PurchaseOrder;
use App\Models\TaskPartner;
use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $partner = Auth::user();
        $tasks = Task::where('partner_id', $partner->id)->get();
        return view('partner/task/index', compact('partner', 'tasks'));
    }
    
    public function statusIndex($task_status)
    {
        $partner = Auth::user();
        $alltasks = Task::where('company_id', $partner->company_id)->with(['project', 'taskCompanies.companyUser', 'taskPartners.partner', 'taskRoleRelation'])->get();

        $taskPartners = TaskPartner::where('partner_id', $partner->id)->get();
        
        $status_arr = [];
        for ($i = 0; $i < 19; $i++) {
            $status_arr[strval($i)] = 0;
        }
        for ($i = 0; $i < $alltasks->count(); $i++) {
            $status_arr[$alltasks[$i]->status]++;
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

        $tasks = Task::where('company_id', $partner->company_id)
                                ->where('status', $task_status)
                                ->with(['project', 'taskCompanies.companyUser', 'taskPartners.partner', 'taskRoleRelation'])
                                ->get();

        return view('partner/task/index', compact('partner', 'tasks', 'statusName_arr', 'status_arr'));
    }

    public function show($id)
    {
        $task = Task::findOrFail($id);
        $purchaseOrder = PurchaseOrder::where('task_id', $id)->first();

        $partner = Auth::user();

        return view('/partner/task/show', compact('task', 'partner', 'purchaseOrder'));
    }
}
