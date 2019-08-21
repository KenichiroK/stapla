<?php

namespace App\Http\Controllers\Companies\Setting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyUser;

use Illuminate\Support\Facades\Auth;

class UserSettingController extends Controller
{
    public function index()
    {
        // 
    }

    public function create()
    {
        $auth = Auth::user(); 
        $company_user = CompanyUser::where('auth_id', $auth->id)->first();
        $companyUsers = CompanyUser::where('company_id', $company_user->company_id)->get();
        return view('company/setting/userSetting/create', compact('companyUsers', 'company_user'));
    }

    public function store(Request $request)
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

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
