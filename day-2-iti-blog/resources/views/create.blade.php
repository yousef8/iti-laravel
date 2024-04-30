@extends('layout')

@section('title', 'Create Post')

@section('content')
<h2 class="mb-3">Add Post</h2>
<form action="/posts/" method="POST">
    @csrf
    <div class="form-floating mb-3">
        <input type="text" name="title" value='{{old('title')}}' class="form-control" id="title" placeholder="name@example.com">
        <label for="title">Title</label>
    </div>
    @error('title')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <div class="form-floating mb-3">
    <textarea name="body" class="form-control" placeholder="Post Content" id="body" style="height: 100px">{{old('body')}}</textarea>
    <label for="body">Body</label>
    </div>
    @error('body')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <div class="mb-3">
    <label for="formFile" name="image" class="form-label">Image</label>
    <input class="form-control" type="file" id="formFile">
    </div>

    <input class="btn btn-primary" type="submit" value="Submit">

</form>
@endsection
