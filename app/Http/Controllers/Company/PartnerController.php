<?php
namespace App\Http\Controllers;
use App\Models\Partner;
use App\Models\CompanyUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PartnerController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $company_id = CompanyUser::where('auth_id', $user->id)->get()->first()->company_id;
        $partners = Partner::where('company_id', $company_id)->with(['projectPartners.project', 'TaskPartners.task'])->get();
        return view('company/partner/index', compact('partners'));
        // $user = Auth::user();
        // $company_id = CompanyUser::where('auth_id', $user->id)->get()->first()->company_id;
        // return Partner::where('company_id', $company_id)->with(['projectPartnerPics.project', 'TaskPartnerPics.task'])->get();
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
        return Partner::with(['projectPartnerPics.project', 'TaskPartnerPics.task', ])->findOrFail($id);
    }
    public function edit($id)
    {
        return Partner::with(['projectPartnerPics.project', 'TaskPartnerPics.task', ])->findOrFail($id);
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
