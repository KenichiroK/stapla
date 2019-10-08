<?php

namespace App\Http\Controllers\Partners;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Partner;
use App\Models\Project;
use App\Models\ProjectPartner;
use App\Models\TaskPartner;
use App\Models\Task;
use App\Models\Nda;
use App\Models\Contract;
use App\Models\PurchaseOrder;
use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function index()
    {
        $partner = Auth::user()->first();
        $partner_id = $partner->id;
        $projects = ProjectPartner::where('user_id', $partner_id)->get();
        $tasks = Task::where('partner_id', $partner_id)->get();
        $ndas = Nda::where('partner_id', $partner_id)->where('status', 0)->get();
        $contracts = Contract::where('partner_id', $partner_id)->where('status', 0)->get();
        $purchaseOrders = PurchaseOrder::where('partner_id', $partner_id)->where('status', 0)->get();
        $invoices = Invoice::where('partner_id', $partner_id)->get();

        return view('partner/dashboard/index', compact(['projects', 'tasks', 'partner', 'invoices', 'purchaseOrders', 'ndas']));
    }
}
