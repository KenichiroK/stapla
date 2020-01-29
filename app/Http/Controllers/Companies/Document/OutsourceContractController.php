<?php

namespace App\Http\Controllers\Companies\Document;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;


class OutsourceContractController extends Controller
{
    public function create()
    {
        return view('/company/document/outsourceContract/create');
    }
}
