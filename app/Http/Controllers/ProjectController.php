<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\CompanyUser;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;


class ProjectController extends Controller
{
    public function index()
    {
        // $user = Auth::user();
        // $company_id = CompanyUser::where('auth_id', $user->id)->get()->first()->company_id;
        // return Project::where('company_id', $company_id)->with(['company', 'tasks', 'projectRoleRelation', 'projectPartnerPics.partner', 'projectCompanyPics.companyUser'])->get();

        return view('company/project/index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'          => 'required|string|max:64ired',
            'detail'        => 'required|string',
            'started_at'    => 'required|date',
            'ended_at'      => 'required|date',
            'status'        => 'required|boolean',
            'budget'        => 'required|regex:/^[0-9]+$/',
            'price'         => 'required|regex:/^[0-9]+$/'
        ]);

        if($validator->fails()){
            return $validator->errors();
        }

        $project = Project::create($request->all());
        return Project::with(['company', 'tasks', 'projectRoleRelation', 'projectPartnerPics.partner', 'projectCompanyPics.companyUser'])->get();
    }

    public function show($id)
    {
        return $projects = Project::with(['company', 'tasks', 'projectRoleRelation', 'projectPartnerPics.partner', 'projectCompanyPics.companyUser'])->findOrFail($id);
    }

    public function edit($id)
    {
        return $projects = Project::with(['company', 'tasks', 'projectRoleRelation', 'projectPartnerPics.partner', 'projectCompanyPics.companyUser'])->findOrFail($id);

    }

    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        $validator = Validator::make($request->all(), [ 
            'name'          => 'required|string|max:64ired',
            'detail'        => 'required|string',
            'started_at'    => 'required|date',
            'ended_at'      => 'required|date',
            'status'        => 'required|boolean',
            'budget'        => 'required|regex:/^[0-9]+$/',
            'price'         => 'required|regex:/^[0-9]+$/'
        ]);

        if($validator->fails()){
            return $validator->errors();
        }
        $project->update($request->all());
        return Project::with(['company', 'tasks', 'projectRoleRelation', 'projectPartnerPics.partner', 'projectCompanyPics.companyUser'])->get();
    }

    public function destroy($id)
    {
        Project::findORFail($id)->delete();
        return Project::with(['company', 'tasks', 'projectRoleRelation', 'projectPartnerPics.partner', 'projectCompanyPics.companyUser'])->get();
    }
}
