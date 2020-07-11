<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Laravel\Lumen\Routing\Controller as BaseController;

class UploadController extends BaseController
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    //
    public function upload(Request $request){

        /**
         * @var UploadedFile $file
         */
        $file=$request->file("file");
        $file->move(storage_path("uploads"),$file->getClientOriginalName());
        return "done";
    }
    public function index(){
        $path=storage_path("uploads");
        return scandir($path);
    }
}
