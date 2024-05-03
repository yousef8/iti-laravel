<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return view('welcome');
});

Route::apiResource('posts', PostController::class)->parameters(['posts' => 'id']);
