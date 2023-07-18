<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;

class TrendController extends Controller
{
    public function trends()
    {


        // $popularHashtag = Post::popularHashtag();
        // dd($popularHashtag);
        // $posts = Post::postHasHashtag($popularHashtag);
        // return view('home.trends', compact('posts', 'popularHashtag'));


        // $allHashtags = Post::getHashtags();
        $mostLikedPost = Post::mostLikedPost()->take(2);
        // dd($mostLikedPost);
        $hashtagCounts = Post::countHashtags()->take(3);
        $hashtags = $hashtagCounts->toArray();
        $posts = Post::all();

        return view('home.trends', compact('posts', 'hashtags', 'mostLikedPost'));

    }
}