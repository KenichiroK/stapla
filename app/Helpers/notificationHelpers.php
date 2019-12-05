<?php
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;

use App\Models\Task;
use App\Models\CompanyUser;
use App\Models\Partner;
use App\Models\ProjectCompany;

// ログインユーザーの通知を返す
if (!function_exists('getNotifications'))
{
    function getNotifications()
    {
        return DatabaseNotification::where('notifiable_id', Auth::user()->id)
                                    ->orderBy('created_at', 'desc')
                                    ->get();
    }
}

// 未読の通知数を返す
if (!function_exists('countReadAtIsNULL'))
{
    function countReadAtIsNULL()
    {
        return DatabaseNotification::where('notifiable_id', Auth::user()->id)
                                    ->where('read_at', NULL)
                                    ->get()
                                    ->count();

    }
}

// タスク作成時に通知を送信する
if (!function_exists('sendNotificationAssignedTask'))
{
    function sendNotificationAssignedTask(Task $task)
    {
        $company_user = CompanyUser::findOrFail($task->company_user_id);
        $superior     = CompanyUser::findOrFail($task->superior_id);
        $accounting   = CompanyUser::findOrFail($task->accounting_id);
        $partner      = Partner::findOrFail($task->partner_id);
        
        Auth::user()->id !== $company_user->id && $company_user->notify(new \App\Notifications\AssignedTask($task, 'COMPANY_USER'));
        Auth::user()->id !== $superior->id && $superior->notify(new \App\Notifications\AssignedTask($task, 'SUPERIOR'));
        Auth::user()->id !== $accounting->id && $accounting->notify(new \App\Notifications\AssignedTask($task, 'ACCOUNTING'));
        Auth::user()->id !== $partner->id && $partner->notify(new \App\Notifications\AssignedTask($task, 'PARTNER'));

    }
}

// 会社側から通知を送信する
if (!function_exists('sendNotificationUpdatedTaskStatusFromCompany')) {
    function sendNotificationUpdatedTaskStatusFromCompany(Task $task, $prevStatus)
    {
        $company_user = CompanyUser::findOrFail($task->company_user_id);
        $superior     = CompanyUser::findOrFail($task->superior_id);
        $accounting   = CompanyUser::findOrFail($task->accounting_id);
        $partner      = Partner::findOrFail($task->partner_id);

        $company_user_status_arr = [
            config('const.TASK_CREATE'), 
            config('const.TASK_APPROVAL_SUPERIOR'), 
            config('const.TASK_APPROVAL_PARTNER'), 
            config('const.ORDER_APPROVAL_SUPERIOR'), 
            config('const.INVOICE_CREATE'), 
            config('const.APPROVAL_ACCOUNTING'), 
            config('const.COMPLETE_STAFF')
        ];
        $superior_status_arr     = [
            config('const.TASK_SUBMIT_SUPERIOR'),
            config('const.ORDER_SUBMIT_SUPERIOR')
        ];
        $accounting_status_arr   = [
            config('const.SUBMIT_ACCOUNTING')
        ];
        $partner_status_arr      = [
            config('const.TASK_SUBMIT_PARTNER'),
            config('const.ORDER_SUBMIT_PARTNER'),
            config('const.WORKING'),
            config('const.ACCEPTANCE'),
        ];

        Auth::user()->id !== $company_user->id && in_array($task->status, $company_user_status_arr)
        && $company_user->notify(new \App\Notifications\UpdatedTaskStatus(
                $task, 
                $task->status, 
                false,
                true
            ));
        
            
        Auth::user()->id !== $superior->id && in_array($task->status, $superior_status_arr) &&
            $superior->notify(new \App\Notifications\UpdatedTaskStatus($task, $task->status, false, true));
        Auth::user()->id !== $accounting->id && in_array($task->status, $accounting_status_arr) &&
            $accounting->notify(new \App\Notifications\UpdatedTaskStatus($task, $task->status, false, true));
        Auth::user()->id !== $partner->id && in_array($task->status, $partner_status_arr) &&
            $partner->notify(new \App\Notifications\UpdatedTaskStatus($task, $task->status, true, true));
    }
}

// パートナー側から通知を送信する
if (!function_exists('sendNotificationUpdatedTaskStatusFromPartner')) {
    function sendNotificationUpdatedTaskStatusFromPartner(Task $task, $prevStatus)
    {
        $company_user = CompanyUser::findOrFail($task->company_user_id);

        $company_user_status_arr = [
            config('const.TASK_CREATE'),
            config('const.TASK_APPROVAL_PARTNER'),
            config('const.DELIVERY_PARTNER'),
            config('const.INVOICE_CREATE')
        ];

        $partner_status_arr      = [
            config('const.TASK_SUBMIT_PARTNER'),
            config('const.ORDER_SUBMIT_PARTNER'),
            config('const.WORKING'),
            config('const.ACCEPTANCE'),
        ];

        if (Auth::user()->id !== $company_user->id) {
             in_array($task->status, $company_user_status_arr)
            ? $company_user->notify(new \App\Notifications\UpdatedTaskStatus(
                $task, 
                $task->status, 
                false,
                true
            )) 
            : $company_user->notify(new \App\Notifications\UpdatedTaskStatus(
                $task, 
                $task->status, 
                false,
                false,
                $prevStatus,
                $task->partner->name
            ));
        }
    }
}

// project にアサインしている担当者に通知を送信する
if (!function_exists('sendNotificationUpdatedTaskStatusToProjectCompany')) {
    function sendNotificationUpdatedTaskStatusToProjectCompany(Task $task, $prev_status)
    {
        $project_companies = ProjectCompany::where('project_id', $task->project_id)->get();

        $company_user_status_arr = [
            config('const.TASK_CREATE'), 
            config('const.TASK_APPROVAL_SUPERIOR'), 
            config('const.TASK_APPROVAL_PARTNER'), 
            config('const.ORDER_APPROVAL_SUPERIOR'), 
            config('const.DELIVERY_PARTNER'),
            config('const.INVOICE_CREATE'), 
            config('const.APPROVAL_ACCOUNTING'), 
        ];
        $superior_status_arr     = [
            config('const.TASK_SUBMIT_SUPERIOR'),
            config('const.ORDER_SUBMIT_SUPERIOR')
        ];
        $accounting_status_arr   = [
            config('const.SUBMIT_ACCOUNTING')
        ];
        $partner_status_arr      = [
            config('const.TASK_SUBMIT_PARTNER'),
            config('const.ORDER_SUBMIT_PARTNER'),
            config('const.ORDER_APPROVAL_PARTNER'),
            config('const.WORKING'),
            config('const.ACCEPTANCE'),
        ];

        $nextActionUser = "";

        if (in_array($task->status, $company_user_status_arr)) {
            $nextActionUser = $task->companyUser->name;
        } elseif (in_array($task->status, $superior_status_arr)) {
            $nextActionUser = $task->superior->name;
        } elseif (in_array($task->status, $accounting_status_arr)) {
            $nextActionUser = $task->accounting->name;
        } elseif (in_array($task->status, $partner_status_arr))  {
            $nextActionUser = $task->partner->name;
        } else {
            $nextActionUser = 'なし';
        }

        foreach ($project_companies as $project_company) {
            if (
                $project_company->user_id    !== $task->company_user_id
                && $project_company->user_id !== $task->superior_id
                && $project_company->user_id !== $task->accounting_id
                && $project_company->user_id !== Auth::user()->id
            ) {
                CompanyUser::findOrFail($project_company->user_id)
                    ->notify(new \App\Notifications\UpdatedTaskStatus(
                        $task, 
                        $task->status,
                        false,
                        false,
                        $prev_status,
                        $nextActionUser
                    ));
            }
        }
    }
}

// NOTE: 招待を送った担当者が登録を完了した時に通知を送信する
// if (!function_exists('sendNotificationRegisteredCompanyUser')) {
//     function sendNotificationAssignedTask(CompanyUser $companyUser)
//     {
//     }
// }
