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

        $users = User::searchUser($search)->get();
        $posts = Post::searchPost($search)->latest()->get();

        return view('home.search.search-result', compact('users', 'posts', 'search'));
    }
}
