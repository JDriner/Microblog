<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Search the database for the keyword entered by the user
     *
     * @param Request $request
     * @return
     */
    public function search(Request $request)
    {
        $postsPerPage = config('microblog.posts_per_page');
        $search = $request->search;

        $users = User::searchUser($search)
            ->paginate($postsPerPage);
        $posts = Post::searchPost($search)
            ->latest()
            ->paginate($postsPerPage);


        return view('home.search.search-result', compact('users', 'posts', 'search'));
    }
}