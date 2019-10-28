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
    public function create()
    {
        $company_user = Auth::user();
        $company = Company::findOrFail($company_user->company_id);
        
        return view('company/setting/general/create', compact('company', 'company_user'));
    }
    
    public function update(CompanyGeneralRequest $request)
    {
        $company_user = Auth::user();
        $company = Company::findOrFail($company_user->company_id);
        \Log::info('会社基本情報(変更前)', ['user_id(company)' => $company_user->id, 'company_id' => $company->id]);

        $company->update($request->all());
        $completed = '変更を保存しました。';
        \Log::info('会社基本情報(変更後)', ['user_id(company)' => $company_user->id, 'company_id' => $company->id]);
        
        return redirect()->route('company.setting.general.create')->with('completed', $completed);
    }
}
