<?php

namespace App\Http\Controllers\Companies\Setting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyUser;

use Illuminate\Support\Facades\Auth;

class UserSettingController extends Controller
{
    public function create()
    {
        $company_user = Auth::user(); 
        $companyUsers = CompanyUser::where('company_id', $company_user->company_id)->where('is_agree', 1)->get();
        return view('company/setting/userSetting/create', compact('companyUsers', 'company_user'));
    }
}
