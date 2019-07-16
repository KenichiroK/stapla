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
        $company_id = CompanyUser::where('auth_id', $auth->id)->get()->first()->company_id;
        $company = Company::findOrFail($company_id);

        $completed = '';

        return view('company/setting/companyElse/create', compact('company', 'completed'));
    }

    public function store(Request $request)
    {
        $auth = Auth::user();
        $company_id = CompanyUser::where('auth_id', $auth->id)->first()->company_id;
        $company = Company::findOrFail($company_id);

        if($company) {
            $company->update($request->all());

            $completed = '変更を保存しました。';

            return view('company/setting/companyElse/create', compact('company', 'completed'));
        }
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
