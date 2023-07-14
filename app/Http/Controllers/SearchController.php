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
        // $->scopeSearch($search);
        // scopeSearch(User, $search);
        $users = User::where('first_name', 'LIKE', '%' . $search . '%')
                ->orWhere('last_name', 'LIKE', '%' . $search . '%')
                ->get();
        $posts = Post::where('content', 'LIKE', '%' . $search . '%')
                ->get();

        return view('home.search.search-result', compact('users', 'posts', 'search'));
    }
}
