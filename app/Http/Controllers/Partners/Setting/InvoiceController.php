<?php

namespace App\Http\Controllers\Partners\Setting;

use Illuminate\Http\Request;
use App\Http\Requests\PartnerInvoiceRequest;
use App\Http\Controllers\Controller;
use App\Models\Partner;
use App\Models\PartnerInvoice;
use Illuminate\Support\Facades\Auth;


class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $auth_id = Auth::user()->id;
        $partner = Partner::where('partner_id', $auth_id)->get()->first();
        $partner_invoice = PartnerInvoice::where('partner_id', $partner->id)->get()->first();
        if ($partner_invoice) {
            $mark_image = str_replace('public/', 'storage/', $partner_invoice->mark_image);
        }
        $completed = '';
        return view('partner/setting/invoice/create', compact('partner', 'partner_invoice', 'mark_image', 'completed'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PartnerInvoiceRequest $request)
    {
        $auth_id = Auth::user()->id;
        $partner = Partner::where('partner_id', $auth_id)->get()->first();
        $partner->name       = $request->name;
        $partner->zip_code   = $request->zip_code;
        $partner->prefecture = $request->prefecture;
        $partner->city       = $request->city;
        $partner->building   = $request->building;
        $partner->tel        = $request->tel;
        $partner->save();

        $partner_invoice = PartnerInvoice::where('partner_id', $partner->id)->get()->first();
        if ($partner_invoice) {
            $time = date("Y_m_d_H_i_s");
            $partner_invoice->financial_institution = $request->financial_institution;
            $partner_invoice->branch                = $request->branch;
            $partner_invoice->deposit_type          = $request->deposit_type;
            $partner_invoice->account_number        = $request->account_number;
            $partner_invoice->account_holder        = $request->account_holder;
            $partner_invoice->mark_image            = $request->file('mark_image')->storeAs('public/images/partner/invoice_mark', $time.'_'.Auth::user()->id . '.png');
            $partner_invoice->save();

            $mark_image = str_replace('public/', 'storage/', $partner_invoice->mark_image);


            $completed = '変更を保存しました。';
            return view('partner/setting/invoice/create', compact('partner', 'partner_invoice', 'mark_image', 'completed'));
        }

        $new_partner_invoice = new PartnerInvoice;
        $time = date("Y_m_d_H_i_s");
        $new_partner_invoice->partner_id            = $partner->id;
        $new_partner_invoice->financial_institution = $request->financial_institution;
        $new_partner_invoice->branch                = $request->branch;
        $new_partner_invoice->deposit_type          = $request->deposit_type;
        $new_partner_invoice->account_number        = $request->account_number;
        $new_partner_invoice->account_holder        = $request->account_holder;
        $new_partner_invoice->mark_image            = $request->mark_image->storeAs('public/images/partner/invoice_mark', $time.'_'.Auth::user()->id . '.png');
        $new_partner_invoice->save();

        $mark_image = str_replace('public/', 'storage/', $new_partner_invoice->mark_image);
        $completed = '変更を保存しました。';
        return view('partner/setting/invoice/create', compact('partner', 'partner_invoice', 'mark_image', 'completed'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
