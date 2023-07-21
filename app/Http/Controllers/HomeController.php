<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $posts = Post::newsFeed()->paginate(5);

        $hashtags = Post::countHashtags()->take(3);
        // $hashtags = $hashtagCounts->toArray();
        $suggestedUsers = User::suggestedUsers()->get();

        // print($suggestedUsers);
        // if ($request->ajax()) {
    	// 	$view = view('post.home-posts', compact('posts'))->render();

        //     return response()->json(['html' => $view]);
        // }

        return view('home.home', compact('posts', 'suggestedUsers', 'hashtags'));
    }

    public function posts()
    {
        $posts = Post::newsFeed()->paginate(5);

        return view('post.home-posts', compact('posts'));
    }
}