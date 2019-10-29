<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Post;

class PostController extends Controller
{
    // 列表
    public function index()
    {
        return view("post/index");
    }

    public function show(Post $post)
    {
        return view("post/postDetail", compact('post'));
    }


}
