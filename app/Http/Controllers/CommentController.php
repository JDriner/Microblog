<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditCommentRequest;
use App\Http\Requests\SendCommentRequest;
use App\Models\Comment;

class CommentController extends Controller
{
    /**
     * Function to store/create the comment
     *
     * @param SendCommentRequest $request
     * @param [type] $postId
     * @return 'json'
     */
    public function sendComment(SendCommentRequest $request, $postId)
    {
        $validated = $request->validated();

        Comment::create([
            'user_id' => auth()->user()->id,
            'post_id' => $postId,
            'comment' => $validated['comment'],
        ]);

        return response()->json([
            'success' => 'Comment has been submitted!.',
        ]);
    }

    /**
     * Fetch a comment for viewing
     * @param [type] $id
     * @return 'json'
     */
    public function view($id)
    {
        $comment = Comment::findOrFail($id);

        return response()->json($comment);
    }

    /**
     * Edit a comment
     * @param EditCommentRequest $request
     * @return 'json'
     */
    public function edit(EditCommentRequest $request, $commentId)
    {
        $validated = $request->validated();
        $comment = Comment::findOrfail($commentId);
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
     * @return 'json'
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