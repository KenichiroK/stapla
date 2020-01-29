<?php

namespace App\Http\Controllers\Companies\Document;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Partner;
use App\Models\OutsourceContract;


class OutsourceContractController extends Controller
{
    public function create($partner_id)
    {
        $companyUser = Auth::user();
        $company = Company::findOrFail($companyUser->company_id);
        $partner = Partner::findOrFail($partner_id);

        return view('/company/document/outsourceContract/create', compact('partner', 'company'));
    }

    // TODO: バリデーションの設定
    public function store(Request $request) {
        // NOTE: 1企業に対しパートナーは業務委託契約書を1枚しか必要ないのでfirstOrNewを使用
        $outsourceContract = OutsourceContract::firstOrNew([
            'company_id' => $request->company_id,
            'partner_id' => $request->partner_id,
        ]);
        $outsourceContract->company_name = $request->company_name;
        $outsourceContract->company_address = $request->company_address;
        $outsourceContract->representive_name = $request->representive_name;
        $outsourceContract->partner_name = $request->partner_name;
        $outsourceContract->partner_address = $request->partner_address;
        $outsourceContract->court_name = $request->court;
        $outsourceContract->contarcted_at = date('Y-m-d', strtotime($request->contract_date));
        $outsourceContract->save();

        return redirect()->route('company.document.outsource-contracts.preview', ['outsource_contract_id' => $outsourceContract->id]);
    }

    public function preview($outsource_contract_id)
    {
        $outsourceContract = OutsourceContract::findOrFail($outsource_contract_id);
        return view('/company/document/outsourceContract/preview', compact('outsourceContract'));
    }

    public function edit($outsource_contract_id)
    {
        $outsourceContract = OutsourceContract::findOrFail($outsource_contract_id);
        return view('/company/document/outsourceContract/edit', compact('outsourceContract'));
    }

    public function update(Request $request)
    {
        $outsourceContract = OutsourceContract::findOrFail($request->id);
        $outsourceContract->company_name = $request->company_name;
        $outsourceContract->company_address = $request->company_address;
        $outsourceContract->representive_name = $request->representive_name;
        $outsourceContract->partner_name = $request->partner_name;
        $outsourceContract->partner_address = $request->partner_address;
        $outsourceContract->court_name = $request->court;
        $outsourceContract->contarcted_at = date('Y-m-d', strtotime($request->contract_date));
        $outsourceContract->save();

        return redirect()->route('company.document.outsource-contracts.preview', ['outsource_contract_id' => $outsourceContract->id]);
    }

    public function updateStatus(Request $request)
    {
        $outsourceContract = OutsourceContract::findOrFail($request->id);
        $outsourceContract->status = $request->status;
        $outsourceContract->save();

        return redirect()->route('company.document.index');
    }
}
