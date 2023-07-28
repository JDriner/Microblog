<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class TrendController extends Controller
{
    /**
     * Get the trending topics and return the results to the view
     * @param Request $request
     * @return
     */
    public function trends(Request $request)
    {
        // number of posts to get/until what number of ranks
        $likeRanks = config('microblog.like_ranks');
        $hashtagCount = config('microblog.hashtag_counts');

        $mostLikedPost = Post::mostLikedPost()
            ->take($likeRanks);

        $postInstance = new Post();
        $hashtagCounts = $postInstance
            ->countHashtags()
            ->take($hashtagCount);

        $hashtags = $hashtagCounts
            ->toArray();

        $posts = Post::get();

        return view(
            'home.trends',
            compact(
                'posts',
                'hashtags',
                'mostLikedPost'
            )
        );
    }
}