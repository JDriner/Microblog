<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendCommentRequest;
use App\Models\Comment;

class CommentController extends Controller
{
    public function sendComment(SendCommentRequest $request)
    {
        $validated = $request->all();
        Comment::create([
            'user_id' => auth()->user()->id,
            'post_id' => $validated['post_id'],
            'comment' => $validated['comment'],
        ]);

        return redirect()->back()->with([
            'comment_success' => 'Comment has been submitted!',
            'postId' => $validated['post_id'],
        ]);
    }
}
