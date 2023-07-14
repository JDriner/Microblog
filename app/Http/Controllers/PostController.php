<?php

namespace App\Http\Controllers;

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
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'content' => 'required|max:140',
            'image' => 'image|file|max:4096', // 4 MB in kilobytes (1 MB = 1024 KB)
        ]);

        if ($validator->fails()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {

        $imagePath = null;

        $postData = [
            'user_id' => Auth::user()->id,
            'content' => $request->content,
        ];
        //Means you are editing a shared post
        if ($request->shared_post_id != null) {
            $postData['post_id'] = $request->shared_post_id;
        }

        //if the user has updated the image
        if ($request->file('image')) {
            $imagePath = $request->file('image')
                ->store('post_picture', 'public');
            $postData['image'] = $request;
        }

        Post::updateOrCreate(
            [
                'id' => $request->post_id,
            ],
            $postData
        );

        return response()->json([
            'success' => 'Post saved successfully.'
        ]);
        }
    }

    public function sharePost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'content' => 'required|max:140',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code' => 0, 
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            Post::create([
                'user_id' => Auth::user()->id,
                'post_id' => $request->post_id,
                'content' => $request->content,
            ]);

            return response()->json([
                'success' => 'Post has been shared successfully.'
            ]);
        }
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
        return view('post.view-post', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        return response()->json($post);
    }

    public function share($id)
    {
        $post = Post::find($id);
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
        Post::find($id)->delete();
        return response()->json([
            'success' => 'Post has been deleted successfully.'
        ]);
    }
}