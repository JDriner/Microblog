<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;

class HomeController extends Controller
{
    public function home()
    {
        $posts = Post::newsFeed()->paginate(3);

        $hashtags = Post::countHashtags()->take(3);
        // $hashtags = $hashtagCounts->toArray();


        $suggestedUsers = User::suggestedUsers()->get();
        // print($suggestedUsers);
        return view('home.home', compact('posts', 'suggestedUsers', 'hashtags'));

        // $posts = Post::get();

        // $suggestedUsers = User::suggestedUsers()->get();
        // foreach($posts as $post){
        //     print("POST: ".$post->id."---".$post->post_id."-----<br>");
        //     if($post->post_id != null){
        //         print("POST SHARE:".$post->share->deleted_at."<br>");
        //     }
        // }
        // dd($posts);
    }
}