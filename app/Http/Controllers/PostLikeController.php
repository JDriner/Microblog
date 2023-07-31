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
    public function likePost(Request $request, $post_id)
    {
        $this->authorize('like', [PostLike::class, $post_id]);
        PostLike::updateOrCreate([
            'user_id' => Auth::user()->id,
            'post_id' => $post_id,
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
    public function unlikePost(Request $request, $post_id)
    {
        $this->authorize('unlike', [PostLike::class, $post_id]);
        $likedPost = PostLike::whereUserId(Auth::id())
            ->wherePostId($post_id)
            ->first();
        $likedPost->delete();

        return response()->json([
            'success' => 'Unliked',
        ]);
    }
}