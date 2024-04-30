<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view("index", compact('posts'));
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validatedData['image'] = '/storage/' . $request->file('image')->store('images', 'public');
        }
        $post = Post::create($validatedData);

        return to_route('posts.show', $post->id);
    }

    public function show(string $id)
    {
        $post = Post::findOrFail($id);
        return view('show', compact('post'));
    }

    public function edit(string $id)
    {
        $post = Post::findOrFail($id);
        return view('edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $post = Post::find($id);
        $post->update($validatedData);

        return to_route('posts.index');
    }

    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return to_route('posts.index');
    }
}
