<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/posts/deleted', [PostController::class, 'indexDeletedPosts'])->name('posts.deleted');
Route::delete('/posts/deleted/permanent/{id}', [PostController::class, 'deletePermanent'])->name('posts.permanent');
Route::get('/posts/deleted/restore/{id}', [PostController::class, 'restoreDeleted'])->name('posts.restore');
Route::resource('posts', PostController::class)->parameters(['posts' => 'id']);
