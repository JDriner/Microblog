<?php

namespace App\Http\Controllers;

use App\Models\Post;

class HomeController extends Controller
{
    public function home()
    {
        $posts = Post::latest()
            // ->isFollowed()
            ->get();

        return view('home.home', compact('posts'));
    }
}
