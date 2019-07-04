<?php

namespace App\Http\Controllers\Companies;

use App\Models\CompanyUser;
use App\Models\Partner;
use App\Mail\PartnerMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;

class PartnerMailController extends Controller
{
    public function index()
    {
        return view('/company/partnerMail/index');
    }
    public function send(Request $request)
    {
        Mail::to($request->email)->send(new PartnerMail());

        $user = Auth::user();
        $company_id = CompanyUser::where('auth_id', $user->id)->get()->first()->company_id;
        $partners = Partner::where('company_id', $company_id)->with(['projectPartners.project', 'TaskPartners.task'])->get();
        return view('company/partner/index', compact('partners'));
    }
}
