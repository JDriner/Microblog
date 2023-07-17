<?php

namespace App\Http\Controllers;

use App\Models\PostLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostLikeController extends Controller
{
    public function likePost(Request $request)
    {
        PostLike::updateOrCreate([
            'user_id' => Auth::user()->id,
            'post_id' => $request->post_id,
        ]);

        return response()->json([
            'success' => 'Liked',
        ]);
    }

    public function unlikePost(Request $request)
    {
        $likedPost = PostLike::whereUserId(Auth::id())
            ->wherePostId($request->post_id)
            ->first();
        $likedPost->delete();

        return response()->json([
            'success' => 'Unliked',
        ]);
    }
}
