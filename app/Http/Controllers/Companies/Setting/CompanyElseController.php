<?php

namespace App\Http\Controllers\Companies\Setting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyUser;

use Illuminate\Support\Facades\Auth;

class CompanyElseController extends Controller
{
    public function index()
    {
        // 
    }

    public function create()
    {
        $auth = Auth::user();
        $compnay_id = CompanyUser::where('auth_id', $auth->id)->get()->first()->company_id;
        $company = Company::where('id', $compnay_id)->get();

        $completed = '';
        return view('company/setting/companyElse/create', compact('company', 'completed'));
    }

    public function store(Request $request)
    {
        $auth = Auth::user();
        $compnay_id = CompanyUser::where('auth_id', $auth->id)->get()->first()->company_id;
        $company = Company::where('id', $compnay_id)->get()->first();

        // return $request;
        // if($company) {
        //     $company->update($request->all());

        //     $completed = '変更を保存しました。';
        //     return view('company/setting/companyElse/create', compact('company', 'completed'));
        // }
        // return $company;

        $company = new Company;
        return $company;
        $company[0]->company_name        = $company[0]->company_name;
        $company->representive_name      = $company->representive_name;
        $company->zip_code               = $company->zip_code;
        $company->address_prefecture     = $company->address_prefecture;
        $company->address_city           = $company->address_city;
        $company->address_building       = $company->address_building;
        $company->tel                    = $company->tel;
        $company->expire                 = $company->expire;
        $company->expire2                = $company->expire2;
        $company->approval_setting       = $request->approval_setting;
        $company->income_tax_setting     = $request->income_tax_setting;
        $company->remind_setting         = $request->remind_setting;
        $company->purchase_order_setting = $request->purchase_order_setting;
        $company->confidential_setting   = $request->confidential_setting;
        $company->save();

        $completed = '変更を保存しました。';
        return view('company/setting/companyElse/create', compact('company', 'completed'));
    }

    public function show($id)
    {
        //
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
