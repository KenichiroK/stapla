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
        $company_user = CompanyUser::where('auth_id', $user->id)->get()->first();
        $partners = Partner::where('company_id', $company_user->company_id)->paginate(6);;
        return view('company/partner/index', compact('partners', 'company_user'));
    }
}
