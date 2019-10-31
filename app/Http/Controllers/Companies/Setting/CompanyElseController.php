<?php

namespace App\Http\Controllers\Companies\Setting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyUser;
use App\Http\Requests\Companies\CompanyElseRequest;

use Illuminate\Support\Facades\Auth;

class CompanyElseController extends Controller
{
    public function create()
    {
        $company_user = Auth::user();
        $company = Company::findOrFail($company_user->company_id);

        return view('company/setting/companyElse/create', compact('company', 'company_user'));
    }

    public function store(CompanyElseRequest $request)
    {
        $company_user = Auth::user();
        $company = Company::findOrFail($company_user->company_id);
        \Log::info('企業情報 その他(変更前)', ['user_id(company)' => $company_user->id]);

        if($company) {
            $company->update($request->all());
            $completed = '変更を保存しました。';
            \Log::info('企業情報 その他(変更後)', ['user_id(company)' => $company_user->id]);

            return redirect()->route('company.setting.companyElse.create')->with('completed', $completed);
        }
    }
}
