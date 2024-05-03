<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Post::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('image')) {
            $validatedData['image'] = '/storage/' . $request->file('image')->store('images', 'public');
        }

        $post = Post::create($validatedData);

        return $post;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        return Post::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, string $id)
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
        return $post;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return to_route('posts.index');
    }
}
