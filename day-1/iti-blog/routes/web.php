<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/{id}', [PostController::class, 'show'])->whereNumber('id');
Route::get('/posts/create', [PostController::class, 'create']);
Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->whereNumber('id');
Route::delete('/posts/{id}', [PostController::class, 'delete'])->whereNumber('id');
