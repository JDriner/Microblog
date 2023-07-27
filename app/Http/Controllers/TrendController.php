<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class TrendController extends Controller
{
    public function trends(Request $request)
    {
        // $popularHashtag = Post::getPopularHashtag();
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
