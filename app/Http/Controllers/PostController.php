<?php

namespace App\Http\Controllers;


use App\Models\post;
use App\Http\Resources\PostResource;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class PostController extends Controller
{
public function index() {
        $posts = Post::all();
        // return response()->json(['data' => $posts]);
        return PostResource::collection($posts);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title'        => 'required|max:255',
            'post_content' => 'required',
            'img_link'     => 'required',
        ]);

        $post = Post::create($validatedData);

        // Create a new PostResource instance and pass the Post model to it
        return new PostResource($post);
    }
}