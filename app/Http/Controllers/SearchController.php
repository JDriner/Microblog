<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $search = $request->search;

        $users = User::searchUser($search)
            ->paginate(5);
        $posts = Post::searchPost($search)
            ->latest()
            ->paginate(5);

        return view('home.search.search-result', compact('users', 'posts', 'search'));
    }
}