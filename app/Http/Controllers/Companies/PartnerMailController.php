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

        $company_id = Auth::user()->company_id;
        $partners = Partner::where('company_id', $company_id)->get();
        return view('company/partner/index', compact('partners'));
    }
}
