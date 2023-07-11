<?php

namespace App\Http\Controllers;

use App\Models\Post;

class HomeController extends Controller
{
    public function home()
    {
        $posts = Post::latest()->get();

        return view('home.home', compact('posts'));
    }
}
