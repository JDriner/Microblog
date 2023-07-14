<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendCommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function sendComment(SendCommentRequest $request)
    {
        $input = $request->all();
        $comment = Comment::create($input);

        return redirect()->back()->with([
            'status' => 'Comment has been submitted!',
            'postId' => $request->post_id
        ]);
    }
}
