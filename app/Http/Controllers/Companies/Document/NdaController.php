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
use App\Http\Requests\Companies\NdaRequest;


class NdaController extends Controller
{
    public function create()
    {
        $company_user = Auth::user();
        $company = Company::findOrFail($company_user->company_id);

        $companyUsers = CompanyUser::where('company_id', $company->id)->get();
        $partners = Partner::where('company_id', $company->id)->get();

        $tasks = Task::where('company_id', $company_user->company_id)->orderBy('project_id')->get();

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

        $asignedProjectPartners = array();
        foreach($partners as $partner){
            if(ProjectPartner::where('user_id', $partner->id)->first() !== null){
                array_push($asignedProjectPartners, ProjectPartner::where('user_id', $partner->id)->first());
            }
        }

        $asignedPartners = array();
        foreach($asignedProjectPartners as $asignedProjectPartner){
            array_push($asignedPartners, Partner::where('id', $asignedProjectPartner->user_id)->first());
        }

        $partners_all =array();
        foreach($partners as $partner){
            array_push($partners_all, $partner);
        }
        $unAsignedPartners = array_diff($partners_all, $asignedPartners);

        return view('company/document/nda/create', compact('companyUsers', 'partners', 'tasks', 'ndaUnDoneTasks', 'ndaDoneTasks', 'asignedPartners', 'unAsignedPartners', 'company_user'));
    }

    public function store(NdaRequest $request)
    {
        $companyUser = Auth::user();
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

        return redirect()->route('company.document.nda.show', [$nda->id]);

    }

    public function show($id)
    {
        $nda = Nda::findOrFail($id);
        $company_user = Auth::user();
        return view('company/document/nda/show', compact('nda', 'company_user'));
    }
}
