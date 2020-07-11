<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    //
    public function store(Request $request){
        if(Gate::denies("posts.create")){
            return "not allow";
        }
        $data = $request->only('title', 'body');
        $data['slug'] = str_slug($data['title']);
        $data['user_id'] = Auth::user()->id;
        $post = Post::create($data);
        return $post;
    }

    public function update(Request $request,$id){
        $post=Post::find($id);
        if(Gate::denies("posts.update",$post)){
            return "not allow";
        }
        $data = $request->only('title', 'body');
        $data['slug'] = str_slug($data['title']);
        $post->fill($data)->save();
        return  $post;
    }
}
