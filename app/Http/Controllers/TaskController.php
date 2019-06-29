<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\CompanyUser;
use Illuminate\Http\Request;
use Validator;

use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $company_id = CompanyUser::where('auth_id', $user->id)->get()->first()->company_id;
        $tasks = Task::where('company_id', $company_id)->with(['project', 'taskCompanies.companyUser', 'taskPartners.partner', 'taskRoleRelation'])->get();
            
        $status_arr = [];
        for ($i = 0; $i < 10; $i++) {
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
    public function projectTaskIndex($project_uid)
    {
        return Task::where('project_id', $project_uid)->get();
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'company_id'      => 'required',
            'project_id'      => 'required',
            'name'            => 'required',
            'content'         => 'required',
            'started_at'      => 'required',
            'ended_at'        => 'required',
            'status'          => 'required',
            'purchaseorder'   => 'required',
            'invoice'         => 'required',
            'budget'          => 'required',
            'price'           => 'required',
            'comment'         => 'required',
            'inspection_date' => 'required',
            'fee_format'      => 'required',
            'delivery_format' => 'required',
            'payment_terms'   => 'required',
            'rating'          => 'required',
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $task = Task::create($request->all());
        return Task::with(['project', 'taskCompanyPics.companyUser', 'taskPartnerPics.partner'])->get();
    }

    public function show($id)
    {
        return Task::with(['project', 'taskCompanyPics.companyUser', 'taskPartnerPics.partner'])->findOrFail($id);
    }
    public function edit($id)
    {
        return Task::with(['project', 'taskCompanyPics.companyUser', 'taskPartnerPics.partner'])->findOrFail($id);
    }
    public function update(Request $request, $id)
    {
        Task::findOrFail($id)->update($request->all());
        return Task::with(['project', 'taskCompanyPics.companyUser', 'taskPartnerPics.partner'])->get();
    }
    public function destroy($id)
    {
        Task::findOrFail($id)->delete();
        return Task::with(['project', 'taskCompanyPics.companyUser', 'taskPartnerPics.partner'])->get();
    }
}
