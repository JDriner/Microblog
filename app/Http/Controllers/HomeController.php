<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;

class HomeController extends Controller
{
    public function home()
    {
        $posts = Post::newsFeed()->paginate(3);

        $hashtags = Post::countHashtags()->take(3);
        // $hashtags = $hashtagCounts->toArray();


        $suggestedUsers = User::suggestedUsers()->get();
        // print($suggestedUsers);
        return view('home.home', compact('posts', 'suggestedUsers', 'hashtags'));
    }
}