<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Laravel\Lumen\Routing\Controller as BaseController;

class UploadController extends BaseController
{
    //
    public function upload(Request $request){

        /**
         * @var UploadedFile $file
         */
        $file=$request->file("file");
        $file->move(storage_path("uploads"),$file->getClientOriginalName());

    }
}
