<?php

namespace App\Http\Controllers\Companies;

use App\Models\Task;
use App\Models\CompanyUser;
use App\Mail\CompanyUserMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;

class CompanyUserMailController extends Controller
{
    public function index()
    {
        return view('/company/companyUserMail/index');
    }
    public function send(Request $request)
    {
        Mail::to($request->email)->send(new CompanyUserMail());

        $user = Auth::user();
        $company_id = CompanyUser::where('auth_id', $user->id)->get()->first()->company_id;
        $tasks = Task::where('company_id', $company_id)->with(['project', 'taskCompanies.companyUser', 'taskPartners.partner', 'taskRoleRelation'])->get();
            
        $status_arr = [];
        for ($i = 0; $i < 11; $i++) {
            $status_arr[strval($i)] = 0;
        }
        for ($i = 0; $i < $tasks->count(); $i++) {
            $status_arr[$tasks[$i]->status]++;
        }

        $statusName_arr = [
            '下書き', '提案中', '依頼前', '依頼中', '開始前','作業中', '提出前', '修正中', '完了', 'キャンセル'
        ];

        return view('company/task/index', compact('tasks','statusName_arr', 'status_arr'));
    }
}
