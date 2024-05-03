<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Jobs\PruneOldPostsJob;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $posts = Post::all();
        return view("index", compact('posts'));
    }

    public function userPosts()
    {
        return view('profile', ['user' => Auth::user()]);
    }

    public function pruneOldPosts()
    {
        dispatch(new PruneOldPostsJob);
        return view('index', ['posts' => Post::all()]);
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
        Gate::authorize('update', $post);
        return view('edit', [
            'post' => Post::findOrFail($id),
            'users' => User::all()
        ]);
    }

    public function update(UpdatePostRequest $request, $id)
    {
        $validatedData = $request->validated();
        $post = Post::findOrFail($id);

        Gate::authorize('update', $post);

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
        Gate::authorize('delete', $post);
        $post->delete();
        return to_route('posts.index');
    }

    public function indexDeletedPosts()
    {
        $posts = Post::onlyTrashed()->get();
        return view("indexDeletedPosts", compact('posts'));
    }

    public function deletePermanent($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        Gate::authorize('forceDelete', $post);
        $post->forceDelete();
        return to_route('posts.deleted');
    }

    public function restoreDeleted($id)
    {
        $post = Post::onlyTrashed()->findOrFail($id);
        Gate::authorize('restore', $post);
        $post->restore();
        return to_route('posts.deleted');
    }
}
