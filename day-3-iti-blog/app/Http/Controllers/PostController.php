<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

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

    public function store(Request $request)
    {
        $validatedData = $request->validate(
            [
                'title' => 'required|string|max:255',
                'body' => 'required|string',
                'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                'user_id' => 'required|string|exists:users,id'
            ],
            [
                'user_id.exists' => "This author doesn't exist"
            ]
        );

        if ($request->hasFile('image')) {
            $validatedData['image'] = '/storage/' . $request->file('image')->store('images', 'public');
        }
        $post = User::find($request['user_id'])
            ->posts()
            ->create($validatedData);

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

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate(
            [
                'title' => 'required|string|max:255',
                'body' => 'required|string',
                'user_id' => 'required|exists:users,id'
            ],
            [
                'user_id.exists' => "This author doesn't exist"
            ]
        );

        Post::find($id)->update($validatedData);

        return to_route('posts.show', $id);
    }

    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return to_route('posts.index');
    }
}
