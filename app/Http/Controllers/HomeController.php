<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    public function home() {
        $posts = Post::latest()->get();

        return view('home.home', compact('posts'));
    }
}
