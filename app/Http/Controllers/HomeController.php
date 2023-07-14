<?php

namespace App\Http\Controllers;

use App\Models\Post;

class HomeController extends Controller
{
    public function home()
    {
        $user = auth()->user();
        // Get the IDs of users being followed
        $following = $user->followings()
            ->pluck('user_following_id'); 
        // ->get();

        $posts = Post::whereIn('user_id', $following)
            ->latest()
            ->get();
        // print($user);
        // print($following);
        // print($posts);

        return view('home.home', compact('posts'));
    }
}