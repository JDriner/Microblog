<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;

class HomeController extends Controller
{
    public function home()
    {
        $posts = Post::newsFeed();

        $suggestedUsers = User::suggestedUsers()->get();
        // print($suggestedUsers);
        return view('home.home', compact('posts', 'suggestedUsers'));
    }
}
