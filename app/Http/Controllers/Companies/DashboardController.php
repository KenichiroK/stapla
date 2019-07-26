<?php

namespace App\Http\Controllers\Companies;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectCompany;
use App\Models\TaskCompany;
use App\Models\Company;
use App\Models\CompanyUser;
use App\Models\Task;
use App\Models\Nda;
use App\Models\Contract;
use App\Models\PurchaseOrder;
use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auth_id = Auth::user()->id;
        $company_user = CompanyUser::where('auth_id', $auth_id)->get()->first();
        $companyUser_id = $company_user->id;
        $company_id = $company_user->company_id;
        $projects = ProjectCompany::where('user_id', $companyUser_id)->get();
        $tasks = TaskCompany::where('user_id', $companyUser_id)->get();
        $invoices = Invoice::where('company_id', $company_id)->get();
        $ndas = Nda::where('company_id', $company_id)->get();
        $contacts = Contract::where('company_id', $company_id)->get();
        $purchaseOrders = PurchaseOrder::where('company_id', $company_id)->get();
        $status_arr = [];
        for ($i = 0; $i < 11; $i++) {
            $status_arr[strval($i)] = 0;
        }
        for ($i = 0; $i < $tasks->count(); $i++) {
            $status_arr[$tasks[$i]->task->status]++;
        }
        $statusName_arr = [
            '下書き', '提案中', '依頼前', '依頼中', '開始前','作業中', '提出前', '修正中', '完了', 'キャンセル'
        ];
        
        return view('company/dashboard/index', compact('projects', 'tasks', 'status_arr', 'statusName_arr', 'invoices', 'purchaseOrders', 'contacts', 'ndas', 'company_user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
