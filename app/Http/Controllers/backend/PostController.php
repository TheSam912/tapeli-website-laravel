<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function AllPosts()
    {
        // If you add a relation author() on Post, this will eager-load it
        $posts = Post::with('author')->latest()->get();

        return view('admin.backend.posts.all_posts', compact('posts'));
    }

    public function AddPost()
    {
        // Load users for the author dropdown
        $users = User::orderBy('name')->get();

        return view('admin.backend.posts.add_post', compact('users'));
    }

    public function StorePost(Request $request)
    {
        $validated = $request->validate([
            'cover_image' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'author_id' => 'required|exists:users,id',
            'read_time' => 'nullable|integer|min:1',
        ]);

        Post::create($validated);

        $notification = [
            'message' => 'Post inserted successfully !',
            'alert-type' => 'success',
        ];

        return redirect()->route('all.posts')->with($notification);
    }

    public function EditPosts($id)
    {
        $post = Post::findOrFail($id);
        $users = User::orderBy('name')->get();

        return view('admin.backend.posts.edit_post', compact('post', 'users'));
    }

    public function UpdatePost(Request $request)
    {
        $post = Post::findOrFail($request->id);

        $validated = $request->validate([
            'cover_image' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'author_id' => 'required|exists:users,id',
            'read_time' => 'nullable|integer|min:1',
        ]);

        $post->update($validated);

        $notification = [
            'message' => 'Post updated successfully !',
            'alert-type' => 'success',
        ];

        return redirect()->route('all.posts')->with($notification);
    }

    public function DeletePost($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        $notification = [
            'message' => 'Post deleted successfully !',
            'alert-type' => 'success',
        ];

        return redirect()->route('all.posts')->with($notification);
    }
}
