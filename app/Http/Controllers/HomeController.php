<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $postsPerPage;
    private $hashtagCounts;
    private $suggestedUserCount;

    public function __construct()
    {
        $this->postsPerPage = config('microblog.posts_per_page');
        $this->hashtagCounts = config('microblog.hashtag_counts');
        $this->suggestedUserCount = config('microblog.suggested_user_count');
    }
    /**
     * Display the contents of the home page
     *
     * @return
     */
    public function home()
    {
        $posts = Post::newsFeed()
        ->paginate($this->postsPerPage);

        $postHashtags = new Post();
        $hashtags = $postHashtags->popularHashtags()
            ->take($this->hashtagCounts);

        $suggestedUsers = User::suggestedUsers()
            ->take($this->suggestedUserCount)
            ->get();

        return view('home.index', compact('posts', 'suggestedUsers', 'hashtags'));
    }
}