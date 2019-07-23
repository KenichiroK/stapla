<?php

namespace App\Http\Controllers\Companies\Document;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyUser;
use App\Models\Partner;
use App\Models\Task;
use App\Models\Nda;
use App\Models\ProjectPartner;

class NdaController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        $auth = Auth::user();
        $companyUser = CompanyUser::where('auth_id', $auth->id)->first();
        $company = Company::findOrFail($companyUser->company_id);

        $companyUsers = CompanyUser::where('company_id', $company->id)->get();
        $partners = Partner::where('company_id', $company->id)->get();

        $tasks = Task::where('company_id', $companyUser->company_id)->orderBy('project_id')->get();

        $ndas = Nda::where('company_id', $company->id)->get();
        $ndaDoneTasks = array();
        foreach($ndas as $nda){
            array_push($ndaDoneTasks, Task::where('id', $nda->task_id)->first());
        }
        $arry_Tasks = array();
        foreach($tasks as $task){
            array_push($arry_Tasks, $task);
        }
        $ndaUnDoneTasks = array_diff($arry_Tasks, $ndaDoneTasks);

        // return ProjectPartner::where('user_id', $partner->id)->first()->id;
        $asignedProjectPartners = array();
        foreach($partners as $partner){
            array_push($asignedProjectPartners, ProjectPartner::where('user_id', $partner->id)->first());
        }
        // return $asignedProjectPartners;

        // $test_array = array();
        // foreach($asignedProjectPartners as $asignedProjectPartner){
        //     echo $asig
        // }
        // return $test_array;
        
        // $asignedPartner = array();
        // foreach($asignedProjectPartners as $asignedProjectPartner){
        //     array_push($asignedPartner, Partner::where('id', $asignedProjectPartner->user_id)->first());
        // }
        // return $asignedPartner;

        return view('company/document/nda/create', compact('companyUsers', 'partners', 'tasks', 'ndaUnDoneTasks', 'ndaDoneTasks', 'asignedProjectPartners'));
    }

    public function store(Request $request)
    {
        $auth = Auth::user();
        $companyUser = CompanyUser::where('auth_id', $auth->id)->first();
        $company = Company::findOrFail($companyUser->company_id);

        $nda= new Nda;
        $nda->company_id = $company->id;
        $nda->companyUser_id = $request->companyUser_id;
        $nda->partner_id =$request->partner_id;
        $nda->task_id =$request->task_id;
        $nda->status = 0;
        $nda->company_name =$company->company_name;
        $nda->partner_name = Partner::findOrFail($request->partner_id)->name;
        $nda->save();

        return redirect()->route('company.document.nda', [$nda->id]);

    }

    public function show($id)
    {
        $nda = Nda::findOrFail($id);
        return view('company/document/nda/show', compact('nda'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
