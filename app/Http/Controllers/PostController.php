<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Post;

class PostController extends Controller
{
    // 列表
    public function index()
    {
//        Post::create([
//            'title'   =>'test',
//            'content'  => 'test',
//            'user_id' => 1
//            ]);

        dd(Post::all());
        return;
    }

}
