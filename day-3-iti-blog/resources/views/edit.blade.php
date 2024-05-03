@extends('layout')

@section('title', 'Edit Post')

@section('content')
<h2 class="mb-3">Edit Post #{{$post->id}}</h2>
<form action="{{route('posts.update', $post->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-floating mb-3">
        <input type="text" value="{{old('title',$post->title)}}" name="title" class="form-control" id="title" placeholder="name@example.com">
        <label for="title">Title</label>
    </div>
    @error('title')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <div class="form-floating mb-3">
    <textarea name="body" class="form-control" placeholder="Post Content" id="body" style="height: 100px">{{old('body', $post->body)}}</textarea>
    <label for="body">Body</label>
    </div>
    @error('body')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <div class="mb-3">
    <label for="formFile" class="form-label">Image</label>
    <input class="form-control" name="image" type="file" id="formFile">
    </div>
    @error('image')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <select name="user_id" class="form-select mb-3" id="floatingSelect" aria-label="label select example">
        <option {{$post->user_id == null ? 'selected' : ''}}  disabled value="">Creator</option>
        @foreach ($users as $user)
            <option {{ $post->user_id == $user->id ? 'selected' : ''}} value="{{$user->id}}">{{$user->name}}</option>
        @endforeach
    </select>
    @error('user_id')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <input class="btn btn-primary" type="submit" value="Submit">

</form>
@endsection
