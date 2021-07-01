<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware("jwt.auth");

    }

    public function profile(){
        return response()->json(['user' => Auth::user()], 200);
    }
}
