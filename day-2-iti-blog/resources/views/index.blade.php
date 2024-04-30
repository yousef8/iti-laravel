@extends('layout')

@section('title', 'Posts')

@section('content')
<a href="{{route('posts.create')}}" class="btn btn-success">+ Add</a>

<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Title</th>
      <th scope="col">Body</th>
      <th scope="col">Image</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($posts as $post)
    <tr>
      <th scope="row">{{$post->id}}</th>
      <td>{{$post->title}}</td>
      <td>{{$post->body}}</td>
      <td>{{$post->image}}</td>
      <td><x-button route='posts.show' id="{{$post->id}}">View</x-button></td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection