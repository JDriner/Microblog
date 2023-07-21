<?php

namespace App\Http\Controllers;

use App\Http\Requests\SharePostRequest;
use App\Http\Requests\EditPostRequest;
use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $validated = $request->validated();
        $imagePath = null;
        $postData = [
            'user_id' => Auth::user()->id,
            'content' => $validated['content'],
        ];
        //if the user has updated the image or it has content
        if ($request->file('image')) {
            $imagePath = $request->file('image')
                ->store('post_picture', 'public');
            $postData['image'] = $imagePath;
        }
        Post::create($postData);
        
        return response()->json([
            'success' => 'Post saved successfully.',
        ]);
    }

    public function editPost(EditPostRequest $request)
    {
        $validated = $request->validated();
        $post = Post::findOrFail($validated['post_id']);
        $this->authorize('update', [Post::class, $post]);
        
        $imagePath = null;
        $postData = [
            'user_id' => Auth::user()->id,
            'content' => $validated['content'],
        ];

        //Means you are editing a shared post
        if ($validated['shared_post_id'] != null) {
            $postData['post_id'] = $validated['shared_post_id'];
        }

        //if the user has updated the image or it has content
        if ($request->file('image')) {
            $imagePath = $request->file('image')
                ->store('post_picture', 'public');
            $postData['image'] = $imagePath;
        }
        $post->update($postData);

        return response()->json([
            'success' => 'Post saved successfully.',
        ]);
    }

    public function sharePost(SharePostRequest $request)
    {
        $validated = $request->validated();
        Post::create([
            'user_id' => Auth::user()->id,
            'post_id' => $validated['post_id'],
            'content' => $validated['content'],
        ]);

        return response()->json([
            'success' => 'Post has been shared successfully.',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);

        return response()->view('post.view-post', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);

        return response()->json($post);
    }

    public function share($id)
    {
        $post = Post::findOrFail($id);

        return response()->json($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $this->authorize('delete', [Post::class, $post]);
        $post->delete();

        return response()->json([
            'success' => 'Post has been deleted successfully.',
        ]);
    }
}