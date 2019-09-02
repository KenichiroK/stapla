<?php

namespace App\Http\Controllers\Companies\Setting;

use Illuminate\Http\Request;
use App\Http\Requests\Companies\CompanyGeneralRequest;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyUser;
use Illuminate\Support\Facades\Auth;

// use Validator;

class GeneralController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        $user = Auth::user();
        $company_user = CompanyUser::where('auth_id', $user->id)->first();
        $company = Company::findOrFail($company_user->company_id);
        
        return view('company/setting/general/create', compact('company', 'company_user'));
    }

    public function store(CompanyGeneralRequest $request)
    {
        //
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }

    public function update(CompanyGeneralRequest $request)
    {
        $auth = Auth::user();
        $company_user = CompanyUser::where('auth_id', $auth->id)->first();
        $company = Company::findOrFail($company_user->company_id);
        $company->update($request->all());
        $completed = '変更を保存しました。';
        
        return redirect()->route('company.setting.general.create')->with('completed', $completed);
    }

    public function destroy($id)
    {
        //
    }
}
