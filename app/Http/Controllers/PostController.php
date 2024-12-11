<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Post;
use illuminate\Support\Facades\Auth;
class PostController extends Controller
{
 public function index()
 {
 return response()->json(Post::all());
 }
 public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);
    
        // Add the authenticated user's ID to the data
        $validatedData['user_id'] = Auth::id();
    
        Post::create($validatedData);
    
        return response()->json(['message' => 'Post created successfully!'], status:201);
    }
 public function show(Post $post)
 {
 return response()->json($post);
 }
 public function update(Request $request, Post $post)
 {
 $request->validate([
 'title' => 'required|string|max:255',
 'content' => 'required|string',
 ]);
 $post->update($request->all());
 return response()->json($post);
 }
 public function destroy(Post $post)
 {
 $post->delete();
 return response()->json(['message' => 'Post deleted successfully']);
 }
} 