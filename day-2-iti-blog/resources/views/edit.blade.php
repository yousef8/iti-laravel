@extends('layout')

@section('title', 'Edit Post')

@section('content')
<form action="{{route('posts.update', $post->id)}}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-floating mb-3">
        <input type="text" value="{{$post->title}}" name="title" class="form-control" id="title" placeholder="name@example.com">
        <label for="title">Title</label>
    </div>
    @error('title')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <div class="form-floating mb-3">
    <textarea name="body" class="form-control" placeholder="Post Content" id="body" style="height: 100px">{{$post->body}}</textarea>
    <label for="body">Body</label>
    </div>
    @error('body')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <div class="mb-3">
    <label for="formFile" name="image" class="form-label">Image</label>
    <input class="form-control" type="file" id="formFile">
    </div>
    @error('image')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <input class="btn btn-primary" type="submit" value="Submit">

</form>
@endsection
