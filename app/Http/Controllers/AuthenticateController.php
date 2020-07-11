<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Laravel\Lumen\Routing\Controller as BaseController;

class AuthenticateController extends Controller
{
    public function __construct()
    {
    }
    public function register(Request $request){
        $this->validate($request,[
            "name"=>"required|string",
            "email"=>"required|email|unique:users",
            "password"=>"required|confirmed"
        ]);

        try {
            $user=new User();
            $user->email=$request->input("email");
            $user->name=$request->input("name");
            $user->password=app("hash")->make($request->input("password"));
            $user->save();
            return  response()->json(["message"=>"Created","user"=>$user],201);

        }catch (\Exception $exception){
            return response()->json(["message"=>"user register failed"],409);
        }
    }

    public function login(Request $request){
        $this->validate($request,[
            "email"=>"required|string",
            "password"=>"required|string"
        ]);

        $credentials=$request->only(["email","password"]);
        if(!$token=Auth::attempt($credentials)){
            return response()->json(["message"=>"email or password invalid"],404);
        }
        return  $this->respondWithToken($token);
    }
}