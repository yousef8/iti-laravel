<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view("index", compact('posts'));
    }

    public function create()
    {
        return view('create', ['users' => User::all()]);
    }

    public function store(StorePostRequest $request)
    {
        $validatedData = $request->validated();

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
        return view('edit', [
            'post' => Post::findOrFail($id),
            'users' => User::all()
        ]);
    }

    public function update(UpdatePostRequest $request, $id)
    {
        $validatedData = $request->validated();
        $post = Post::findOrFail($id);

        if ($request->hasFile('image')) {
            $validatedData['image'] = '/storage/' . $request->file('image')->store('images', 'public');
        }

        if ($request->hasFile('image') && $post->image) {
            Storage::disk('public')->delete('images/' . basename($post->image));
        }

        $post->update($validatedData);
        return to_route('posts.show', $id);
    }

    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return to_route('posts.index');
    }
}
