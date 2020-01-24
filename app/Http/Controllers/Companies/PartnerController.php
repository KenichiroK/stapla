<?php

namespace App\Http\Controllers\Companies;

use App\Models\Partner;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class PartnerController extends Controller
{
    public function index()
    {
        $companyUser = Auth::user();
        $partners = Partner::where('company_id', $companyUser->company_id)->paginate(6);;
        return view('company/partner/index', compact('partners'));
    }
}
