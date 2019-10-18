<?php

namespace App\Http\Controllers\Companies\Setting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\CompanyUser;

class AccountController extends Controller
{
    public function create()
    {
        $company_user = Auth::user();
        return view('company/setting/account/create', compact('company_user'));
    }
}
