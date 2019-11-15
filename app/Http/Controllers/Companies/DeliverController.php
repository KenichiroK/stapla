<?php

namespace App\Http\Controllers\Companies;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class DeliverController extends Controller
{
    public function download(Request $request)
    {
        $disk = Storage::disk('s3');
        $file_path = explode('amazonaws.com/', $request->file)[1];
        $file_name = explode('deliver-file/', $request->file)[1];
        $mime_type = \File::extension($file_name);
        $headers = [
            'Content-Type' => $mime_type,
            'Content-Disposition' => ' attachment; filename="'.$file_name.'"',
        ];
        return \Response::make($disk->get($file_path), 200, $headers);
    }
}
