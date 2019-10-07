<?php

namespace App\Http\Controllers\Companies\Invite;

use App\Mail\InvitePartnerMail;
use App\Models\CompanyUser;
use App\Models\Partner;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Companies\InvitePartnerRequest;
use Illuminate\Support\Facades\Mail;


class InvitePartnerController extends Controller
{
    public function index()
    {
        $company_user = Auth::user()->id;
        return view('company/invite/partner/create', compact('company_user'));
    }

    public function send(InvitePartnerRequest $request)
    {
        $email = $request->email;
        $company_user = Auth::user()->id;
        $company_id = $company_user->company_id;
        Mail::to($request->email)->send(new InvitePartnerMail($company_id, $email));

        $partners = Partner::where('company_id', $company_user->company_id)->with(['projectPartners.project', 'TaskPartners.task'])->paginate(6);;
        return redirect()->route('company.partner.index')->with('send_success', $email.'に招待メールを送信しました。');
    }
}
