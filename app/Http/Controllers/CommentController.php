<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditCommentRequest;
use App\Http\Requests\SendCommentRequest;
use App\Models\Comment;

class CommentController extends Controller
{
    public function sendComment(SendCommentRequest $request)
    {
        $validated = $request->validated();

        Comment::create([
            'user_id' => auth()->user()->id,
            'post_id' => $validated['post_id'],
            'comment' => $validated['comment'],
        ]);

        return response()->json([
            'success' => 'Comment has been submitted!.',
        ]);
    }

    public function view($id)
    {
        $comment = Comment::findOrFail($id);

        return response()->json($comment);
    }

    public function editComment(EditCommentRequest $request)
    {
        $validated = $request->validated();
        $comment = Comment::findOrfail($validated['comment_id']);
        $this->authorize('update', [Comment::class, $comment]);

        $comment->update([
            'comment' => $validated['comment'],
        ]);

        return response()->json([
            'success' => 'Comment has been updated!.',
        ]);
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $this->authorize('delete', [Comment::class, $comment]);
        $comment->delete();

        return response()->json([
            'success' => 'Comment has been deleted successfully.',
        ]);
    }
}
