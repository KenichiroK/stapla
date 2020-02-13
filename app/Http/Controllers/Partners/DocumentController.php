<?php

namespace App\Http\Controllers\Partners;

use App\Http\Controllers\Controller;
use App\Http\Requests\Partners\Document\OutsourceContractUpdateComment;
use App\Http\Requests\Partners\Document\OutsourceContractUpdateStatus;
use App\Models\Company;
use App\Models\CompanyUser;
use App\Models\Invoice;
use App\Models\OutsourceContract;
use App\Models\Partner;
use App\Models\PurchaseOrder;
use App\Notifications\Partner\Document\CompleteOutsourceContract;
// HACK: フォームリクエストと名前かぶってるところ useの量増えてきたらas付けて接尾語にNotificationをつける
use App\Notifications\Partner\Document\UpdateCommentOutsourceContract;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{
    public function index()
    {
        $partner = Auth::user();
        $invoices = Invoice::where('partner_id', $partner->id)->get(); 
        $purchaseOrders = PurchaseOrder::where('partner_id', $partner->id)->get();
        $outsourceContracts = OutsourceContract::where('partner_id', $partner->id)->get();

        return view('partner.document.index', compact('invoices', 'purchaseOrders', 'outsourceContracts'));
    }

    // NOTE: partnerのdocument周りがリファクタされるまでは接尾語にOutsource付けて対応
    public function editOutsource($outsource_contract_id)
    {
        $outsourceContract = OutsourceContract::findOrFail($outsource_contract_id);
        return view('partner.document.outsourceContract.edit', compact('outsourceContract'));
    }

    public function updateOutsourceComment(OutsourceContractUpdateComment $request)
    {
        $outsourceContract = OutsourceContract::findOrFail($request->id);
        $outsourceContract->comment = $request->comment;
        $outsourceContract->save();

        $partner = Auth::user();
        $company = Company::findOrFail($outsourceContract->company_id);
        $companyUser = CompanyUser::findOrFail($outsourceContract->company_user_id);
        $companyUser->notify(new UpdateCommentOutsourceContract($company, $partner, $outsourceContract));

        return redirect()->route('partner.document.index');
    }

    public function updateOutsourceStatus(OutsourceContractUpdateStatus $request)
    {
        $outsourceContract = OutsourceContract::findOrFail($request->id);
        $outsourceContract->status = $request->status;
        $outsourceContract->save();

        $partner = Auth::user();
        $company = Company::findOrFail($outsourceContract->company_id);
        $companyUser = CompanyUser::findOrFail($outsourceContract->company_user_id);
        $companyUser->notify(new CompleteOutsourceContract($company, $partner, $outsourceContract));

        return redirect()->route('partner.document.index');
    }
}
