@extends('layout')

@section('title', 'Post')

@section('content')
<div class="card" style="width: 18rem;">
  <img src="{{$post->image}}" class="card-img-top" alt="post cover image">
  <div class="card-body">
    <h5 class="card-title">{{$post->title}}</h5>
    <p class="card-text">{{$post->body}}</p>
  </div>
</div>
@endsection