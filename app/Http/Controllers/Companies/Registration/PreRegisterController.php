<?php

namespace App\Http\Controllers\Companies\Registration;

use App\Http\Controllers\Controller;
use App\Models\CompanyUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PreRegisterController extends Controller
{
    public function index()
    {
        return view('company/auth/verify');
    }
}
