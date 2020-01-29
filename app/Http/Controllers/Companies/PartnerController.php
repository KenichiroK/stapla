<?php

namespace App\Http\Controllers\Companies;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use App\Models\Partner;

class PartnerController extends Controller
{
    public function index(Request $request)
    {
        $companyUser = Auth::user();

        // HACK: ビルダにフィルタ条件を追加したい
        $partnerBuilder = Partner::where('company_id', $companyUser->company_id)->where('is_agree', true);

        if (isset($request->status)) {
            // HACK: ifのネストしたくない
            // HACK: whereHas系のメソッド重いので後々joinとか使うようにリファクタ
            if ($request->status === 'uncontracted') {
                $partnerBuilder
                    ->whereDoesntHave('outsourceContracts', function ($query) use ($companyUser) {
                        $query->where('company_id', $companyUser->company_id);
                    })
                    ->orWhereHas('outsourceContracts', function ($query) use ($companyUser, $request) {
                        $query->where('company_id', $companyUser->company_id);
                        $query->where('status', $request->status);
                    });
            } else {
                $partnerBuilder->whereHas('outsourceContracts', function ($query) use ($companyUser, $request) {
                    $query->where('company_id', $companyUser->company_id);
                    $query->where('status', $request->status);
                });
            }
        }

        $partners = $partnerBuilder->orderBy('created_at', 'desc')->paginate(20);

        foreach ($partners as $partner) {
            $partner['outsourceContract'] = $partner->outsourceContracts()->where('company_id', $companyUser->company_id)->first();
        }

        // HACK: 二回クエリ叩いているところ
        $partnersForCount = Partner::where('company_id', $companyUser->company_id)->where('is_agree', true)->get();
        $outsourceContractCount = [
            'all' => $partnersForCount->count(),
            'uncontracted' => 0,
            'complete' => 0,
            'progress' => 0,
        ];
        foreach ($partnersForCount as $partner) {
            $outsourceContract = $partner->outsourceContracts()->where('company_id', $companyUser->company_id)->first();
            if (!isset($outsourceContract)) {
                $outsourceContractCount['uncontracted']++;
            } elseif ($outsourceContract->status == 'complete') {
                $outsourceContractCount['complete']++;
            } else {
                $outsourceContractCount['progress']++;
            }
        }

        return view('company/partner/index', compact('partners', 'outsourceContractCount'));
    }
}
