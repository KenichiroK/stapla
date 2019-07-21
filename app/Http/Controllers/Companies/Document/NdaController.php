<?php

namespace App\Http\Controllers\Companies\Document;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Nda;

class NdaController extends Controller
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
        $nda = Nda::findOrFail($id);
        return view('company/document/nda/show', compact('nda'));
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
