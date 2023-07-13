<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request) {
        $search = $request->search;
        $users = User::where([
            ['first_name', '!=', Null],
            [function ($query) use ($request) {
                if (($s = $request->search)) {
                    $query->orWhere('first_name', 'LIKE', '%' . $s . '%')
                        ->orWhere('last_name', 'LIKE', '%' . $s . '%')
                        ->get();
                }
            }]
        ])->get();

        $posts = Post::where([
            ['content', '!=', Null],
            [function ($query) use ($request) {
                if (($s = $request->search)) {
                    $query->orWhere('content', 'LIKE', '%' . $s . '%')
                        ->get();
                }
            }]
        ])->get();

        return view('home.search.search-result', compact('users', 'posts', 'search'));
    }
}
