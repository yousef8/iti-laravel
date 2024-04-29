<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    private $posts = [
        0 => [
            "id" => 1,
            "title" => "t1",
            "body" => "body 1",
            "image_url" => "/fake/path",
        ],
        1 => [
            "id" => 2,
            "title" => "t2",
            "body" => "body 2",
            "image_url" => "/fake/path/2",
        ],
        2 => [
            "id" => 3,
            "title" => "t3",
            "body" => "body 3",
            "image_url" => "/fake/path/e",
        ],
    ];

    public function index()
    {
        return view("index", ['posts' => $this->posts]);
    }
    public function show($id)
    {
        return view('show', ['post' => $this->posts[$id - 1]]);
    }

    public function create()
    {
        return view('create');
    }

    public function edit($id)
    {
        return view('edit')->with('post', $this->posts[$id - 1]);
    }

    public function destroy($id)
    {
        return "This is  the destroy() method";
    }
}
