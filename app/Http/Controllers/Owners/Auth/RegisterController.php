<?php

namespace App\Http\Controllers\Owners\Auth;

use App\Http\Controllers\Controller;
use App\Models\Owner;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    public function index()
    {
        return view('owner/auth/register');
    }

    protected $redirectTo = '/owner/personal_info';

    public function __construct()
    {
        $this->middleware('guest:owner');
    }

 

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:owners'],
            'password' => ['required', 'min:4'],
        ]);
    }

    protected function create(array $data)
    {
        return Owner::create([
            'email'    => $data['email'],
            'password' => $data['password'],
        ]);
    }

    protected function guard()
    {
        return Auth::guard('owner');
    }

}
