@extends('layouts.app')

@section('title', 'Post')

@section('content')
<div class="card" style="width: 18rem;">
  <img src="{{$post->image}}" class="card-img-top" alt="post cover image">
  <div class="card-body">
    <h5 class="card-title">{{$post->title}}</h5>
    <p class="card-text">{{$post->body}}</p>
    <p class="card-text"><b>Author:</b> {{$post->creator->name}}</p>
    <p class="card-text"><b>Created At:</b> {{$post->created_at->toDayDateTimeString()}}</p>
    <a href="{{route('posts.edit', $post->id)}}" ><x-button type="warning">Edit</x-button></a>
    <form action="{{route('posts.destroy', $post->id)}}" method="POST">
      @csrf
      @method('delete')
    <input type="submit" class="btn btn-danger" value='Delete' onclick="return confirm('Are you sure?')"/>
  </form>
  </div>
</div>
@endsection