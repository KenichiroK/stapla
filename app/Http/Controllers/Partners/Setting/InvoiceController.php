<?php

namespace App\Http\Controllers\Partners\Setting;

use Illuminate\Http\Request;
use App\Http\Requests\Partners\PartnerInvoiceRequest;
use App\Http\Controllers\Controller;
use App\Models\Partner;
use App\Models\PartnerInvoice;
use Illuminate\Support\Facades\Auth;


class InvoiceController extends Controller
{
    public function create()
    {
        $partner = Auth::user();
        $partner_invoice = PartnerInvoice::where('partner_id', $partner->id)->get()->first();

        return view('partner/setting/invoice/create', compact('partner_invoice'));
    }

    public function store(PartnerInvoiceRequest $request)
    {
        $partner = Auth::user();
        \Log::info('パートナー情報(変更前)', ['user_id(partner)' => $partner->id]);
        $partner->update($request->all());
        \Log::info('パートナー情報(変更後)', ['user_id(partner)' => $partner->id]);

        $partner_invoice = PartnerInvoice::where('partner_id', $partner->id)->get()->first();
        if ($partner_invoice) {
            $time = date("Y_m_d_H_i_s");
            \Log::info('パートナー請求書(変更前)', ['user_id(partner)' => $partner->id]);
            $partner_invoice->update($request->all());
            $completed = '変更を保存しました。';
            \Log::info('パートナー請求書(変更後)', ['user_id(partner)' => $partner->id]);

            return redirect()->route('partner.setting.invoice.create')->with('completed', $completed);
        }

        $new_partner_invoice = new PartnerInvoice;
        $time = date("Y_m_d_H_i_s");
        $new_partner_invoice->partner_id            = $partner->id;
        $new_partner_invoice->financial_institution = $request->financial_institution;
        $new_partner_invoice->branch                = $request->branch;
        $new_partner_invoice->deposit_type          = $request->deposit_type;
        $new_partner_invoice->account_number        = $request->account_number;
        $new_partner_invoice->account_holder        = $request->account_holder;
        $new_partner_invoice->save();
        \Log::info('パートナー請求書 新規作成', ['user_id(partner)' => $partner->id, 'partner_invoice_id' => $new_partner_invoice->id]);

        $partner_invoice = $new_partner_invoice;

        $completed = '変更を保存しました。';
        return redirect()->route('partner.setting.invoice.create')->with('completed', $completed);
    }
}
