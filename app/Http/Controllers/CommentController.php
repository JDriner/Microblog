<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditCommentRequest;
use App\Http\Requests\SendCommentRequest;
use App\Models\Comment;

class CommentController extends Controller
{
    /**
     * Function to store/create the comment
     * @param SendCommentRequest $request
     * @return
     */
    public function sendComment(SendCommentRequest $request, $post_id)
    {
        $validated = $request->validated();

        Comment::create([
            'user_id' => auth()->user()->id,
            'post_id' => $post_id,
            'comment' => $validated['comment'],
        ]);

        return response()->json([
            'success' => 'Comment has been submitted!.',
        ]);
    }

    /**
     * Fetch a comment for viewing
     * @param [type] $id
     * @return void
     */
    public function view($id)
    {
        $comment = Comment::findOrFail($id);

        return response()->json($comment);
    }

    /**
     * Edit a comment
     * @param EditCommentRequest $request
     * @return
     */
    public function edit(EditCommentRequest $request, $comment_id)
    {
        $validated = $request->validated();
        $comment = Comment::findOrfail($comment_id);
        $this->authorize('update', [Comment::class, $comment]);

        $comment->update([
            'comment' => $validated['comment'],
        ]);

        return response()->json([
            'success' => 'Comment has been updated!',
        ]);
    }

    /**
     * Delete a comment
     * @param [type] $id
     * @return void
     */
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