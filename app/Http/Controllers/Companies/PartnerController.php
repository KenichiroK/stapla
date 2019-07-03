<?php

namespace App\Http\Controllers\Companies;

use App\Models\Task;
use App\Models\Partner;
use App\Models\TaskPartner;
use App\Models\CompanyUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class PartnerController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $company_id = CompanyUser::where('auth_id', $user->id)->get()->first()->company_id;
        $partners = Partner::where('company_id', $company_id)->with(['projectPartners.project', 'TaskPartners.task'])->get();
        return view('company/partner/index', compact('partners'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'partner_id'    => 'required',
            'name'          => 'required',
            'zip_code'      => 'required',
            'address'       => 'required',
            'tel'           => 'required',
            'age'           => 'required',
            'sex'           => 'required',
            'picture'       => 'required',
            'occupations'   => 'required',
            'academic'      => 'required',
            'slack'         => 'nullable',
            'chatwork'      => 'nullable',
            'twitter'       => 'nullable',
            'facebook'      => 'nullable',
            'careersummary' => 'required', 
            'jobcareer'     => 'required',
            'portfolio'     => 'nullable',
            'introduction'  => 'required',
            'possible'      => 'nullable',
            'skill'         => 'nullable',
            'feature'       => 'required',
            'language'      => 'nullable',
            'qualification' => 'nullable',
            'relatedlinks'  => 'nullable',
            'attachment'    => 'nullable', 
        ]);
        if($validator->fails()){
            return $validator->errors();
        }
        $partner = Partner::create($request->all());
        $user = Auth::user();
        $company_id = CompanyUser::where('auth_id', $user->id)->get()->first()->company_id;
        return Partner::where('company_id', $company_id)->with(['projectPartnerPics.project', 'TaskPartnerPics.task'])->get();
        
    }

    public function show($id)
    {
        $tasks = TaskPartner::where('user_id', $id)->with(['task', 'task.project'])->get();
        $partners = Partner::with(['projectPartners.project', 'TaskPartners.task', ])->findOrFail($id);
        return view('company/partner/show', compact('partners', 'tasks'));
    }

    public function edit($id)
    {
        return Partner::with(['projectPartners.project', 'TaskPartners.task', ])->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $partner = Partner::findOrFail($id);
        $validator = Validator::make($request->all(),[
            'partner_id'    => 'required',
            'name'          => 'required|string',
            'zip_code'      => 'required',
            'address'       => 'required',
            'tel'           => 'required',
            'age'           => 'required',
            'sex'           => 'required',
            'picture'       => 'required',
            'occupations'   => 'required',
            'academic'      => 'required',
            'slack'         => 'nullable',
            'chatwork'      => 'nullable',
            'twitter'       => 'nullable',
            'facebook'      => 'nullable',
            'careersummary' => 'required', 
            'jobcareer'     => 'required',
            'portfolio'     => 'nullable',
            'introduction'  => 'required',
            'possible'      => 'nullable',
            'skill'         => 'nullable',
            'feature'       => 'required',
            'language'      => 'nullable',
            'qualification' => 'nullable',
            'relatedlinks'  => 'nullable',
            'attachment'    => 'nullable',
        ]);
        if($validator->fails()){
            return $validator->errors();
        }
        $partner->update($request->all());
        return $partner::with(['projectPartnerPics.project', 'TaskPartnerPics.task', ])->findOrFail($id);
    }

    public function destroy($id)
    {
        Partner::findOrFail($id)->delete();
        return Partner::with(['projectPartnerPics.project', 'TaskPartnerPics.task', ])->get();
    }
}
