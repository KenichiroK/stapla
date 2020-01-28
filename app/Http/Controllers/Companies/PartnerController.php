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
        // NOTE: 企業-パートナー間の契約書フロー実装後にis_agree条件削除
        $partners = Partner::where('company_id', $companyUser->company_id)->where('is_agree', true)->paginate(20);
        return view('company/partner/index', compact('partners'));
    }
}
