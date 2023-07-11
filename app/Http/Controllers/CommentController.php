<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function sendComment(Request $request)
    {
        // print_r($request->post_id);
        $request->validate([
            'comment' => ['required', 'max:140'],
        ]);

        $comment = new Comment;
        $comment->user_id = Auth::user()->id;
        $comment->post_id = $request->post_id;
        $comment->message = $request->comment;
        $comment->save();

        return redirect()->back()->with('status', 'Comment has been submitted!');
    }
}
