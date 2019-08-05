<?php

namespace App\Http\Controllers\Partners;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Support\Facades\Auth;

class InitialRegisterController extends Controller
{
    public function resetPassword()
    {
        return view('partner/inviteRegister/reset-password'); 
    }
}
