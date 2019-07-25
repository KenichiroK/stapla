<?php

namespace App\Http\Controllers\Companies\Setting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\CompanyUser;

class AccountController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        $auth = Auth::user();
        $company_user = CompanyUser::where('auth_id', $auth->id)->first();
        return view('company/setting/account/create', compact('company_user'));
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
