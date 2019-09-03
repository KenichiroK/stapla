<?php

namespace App\Http\Controllers\Companies\Setting;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyUser;
use App\Http\Requests\Companies\PersonalRequest;



class PersonalInfoController extends Controller
{
    public function index()
    {
        //
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

    public function edit()
    {
        $auth = Auth::user();
        $companyUser = CompanyUser::where('auth_id', $auth->id)->first();

        $completed = '';

        return view('/company/setting/personalInfo/create', compact('companyUser', 'completed'));
    }

    public function update(PersonalRequest $request)
    {
        $auth = Auth::user();
        $companyUser = CompanyUser::where('auth_id', $auth->id)->first();
        
        if($companyUser) {
            $companyUser->update($request->all());
            $time = date("Y_m_d_H_i_s");

            if($request->picture) {
                $companyUser->picture = $request->picture->storeAs('public/images/company/profile', $time.'_'.Auth::user()->id . $request->picture->getClientOriginalExtension());
                $companyUser->save();
            }
            $completed = '変更を保存しました。';

            return redirect()->route('company.setting.personalInfo.edit')->with('completed', $completed);
        }
    }

    public function destroy($id)
    {
        //
    }
}
