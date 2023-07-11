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

        return response()->json(['success' => 'Liked']);
    }

    public function unlikePost(Request $request)
    {
        $liked_post = PostLike::where('user_id', Auth::user()->id)
            ->where('post_id', $request->post_id)
            ->first();
        $liked_post->delete();

        return response()->json(['success' => 'Unliked']);
    }
}
