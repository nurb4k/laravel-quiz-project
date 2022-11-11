<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{


    public function index()
    {
        $allPosts = Post::all();
        $categories = Category::all();
        return view('posts.index', ['posts' => $allPosts, 'categories' => $categories]);
    }

    public function create()
    {
        return view('posts.create', ['categories' => Category::all()]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'required|numeric|exists:categories,id',

        ]);
        Post::create($validated);
        return redirect()->route('posts.index')->with('message', 'Post saktaldy');

    }

    public function show(Post $post)
    {
        $categories = Category::all();
        $comments = Comment::all()->where('post_id', $post->id);
        return view('posts.show', ['post' => $post, 'comments' => $comments, 'categories' => $categories]);
    }

    public function edit(Post $post)
    {
        return view('posts.edit', ['post' => $post, 'categories' => Category::all()]);
    }

    public function update(Request $request, Post $post)
    {

        $post->update([
            'title' => $request->title,
            'content' => $request->input('content'),
        ]);
        return redirect()->route('posts.index');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index');
    }

    public function postsByCategory(Category $category)
    {

        $posts = $category->posts;

        return view('posts.index', ['posts' => $posts, 'categories' => Category::all()]);

    }


}
