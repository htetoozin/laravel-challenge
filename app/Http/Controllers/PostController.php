<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\PostResource;
use App\Http\Controllers\BaseController;

class PostController extends BaseController
{
    public function index()
    {
        $posts = Post::with('tags')->withCount('likes')->get();

        $data = PostResource::collection($posts);
        return $this->responseSuccess($data);
    }

    public function toggleReaction(Request $request, Post $post)
    {
         $validator = Validator::make($request->all(), [
            'like'    => ['required', 'boolean'],
        ], [
            'required' => ':attribute is required.',
            'boolean'  => ':attribute must be boolean.'
        ]);

        if ($validator->fails()) {
            return $this->responseError($validator->errors()->first());
        }

        if ($post->author_id == auth()->id()) {
            return $this->responseError('You cannot like your post', 500);
        }

        $toggleLike = auth()->user()->likes()->toggle($post);

        $isLiked = !!count($toggleLike['attached']);

        return response()->json([
            'status' => 200,
            'message' => $isLiked ? 
                    'You like this post successfully': 
                    'You unlike this post successfully'
        ]);
    }
}
