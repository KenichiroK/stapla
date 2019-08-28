<?php

namespace App\Http\Controllers\Companies\Registration;

use App\Http\Controllers\Controller;
use App\Models\CompanyUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PreRegisterController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest:company');
    }

    
    public function index()
    {
        $auth = Auth::user();
        $companyUser = CompanyUser::where('auth_id', $auth->id)->first();
        
        if(isset($companyUser)){
            return  redirect('company/dashboard');
        } else{
            return view('company/auth/verify');
        }
        return view('company/auth/verify');
        }

    public function create()
    {
        //
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
