<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('tags')->withCount('likes')->get();

        $data = PostResource::collection($posts);

        return response()->json([
            'status' => 200,
            'data' => $data,
        ], 200);
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
            return response([
                'status' => 422,
                'message' => $validator->errors()->first()
            ], 422);
        }

        if ($post->author_id == auth()->id()) {
            return response()->json([
                'status' => 500,
                'message' => 'You cannot like your post',
            ]);
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
