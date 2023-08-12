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

    public function update(Request $request, $id) {
        try {
            $post = Post::findOrFail($id);
    
            $validatedData = $request->validate([
                'title'        => 'required|max:255',
                'post_content' => 'required',
                'img_link'     => 'nullable', // Anda dapat menggunakan nullable jika ingin mengizinkan img_link kosong
            ]);
    
            $post->fill($validatedData);
            $post->save();
    
            return new PostResource($post);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Update failed'], 500);
        }
    }
    
    public function destroy($id) {
        try {
            $post = Post::findOrFail($id);
            $post->delete();
    
            return response()->json(['message' => 'Post deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Delete failed'], 500);
        }
    }
    
}