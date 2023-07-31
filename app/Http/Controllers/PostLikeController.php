<?php

namespace App\Http\Controllers;

use App\Models\PostLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostLikeController extends Controller
{
    /**
     * The user likes a post/clicks on the like button
     * @param Request $request
     * @return void
     */
    public function likePost(Request $request)
    {
        $this->authorize('like', [PostLike::class, $request->post_id]);
        PostLike::updateOrCreate([
            'user_id' => Auth::user()->id,
            'post_id' => $request->post_id,
        ]);

        return response()->json([
            'success' => 'Liked',
        ]);
    }

    /**
     * The user unlikes a post/clicks on th eunlike button
     * @param Request $request
     * @return void
     */
    public function unlikePost(Request $request)
    {
        $this->authorize('unlike', [PostLike::class, $request->post_id]);
        $likedPost = PostLike::whereUserId(Auth::id())
            ->wherePostId($request->post_id)
            ->first();
        $likedPost->delete();

        return response()->json([
            'success' => 'Unliked',
        ]);
    }
}