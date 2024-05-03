<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/posts/deleted', [PostController::class, 'indexDeletedPosts'])->name('posts.deleted');
Route::delete('/posts/deleted/permanent/{id}', [PostController::class, 'deletePermanent'])->name('posts.permanent');
Route::get('/posts/deleted/restore/{id}', [PostController::class, 'restoreDeleted'])->name('posts.restore');
Route::resource('posts', PostController::class)->parameters(['posts' => 'id']);
