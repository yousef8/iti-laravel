@extends('layouts.app')

@section('title', 'Posts')

@section('content')
<a href="{{route('posts.create')}}" class="btn btn-success">+ Add</a>

<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Title</th>
      <th scope="col">Body</th>
      <th scope="col">Creator</th>
      <th scope="col">Created At</th>
      <th scope="col">Image</th>
      <th scope="col">Restore</th>
      <th scope="col">Force Delete</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($posts as $post)
    <tr>
      <th scope="row">{{$post->id}}</th>
      <td>{{$post->title}}</td>
      <td>{{$post->body}}</td>
      <td>{{$post->creator->name}}</td>
      <td>{{$post->created_at->toDayDateTimeString()}}</td>
      <td>{{$post->image}}</td>
      <td>
        @can('restore', $post)
          <a href="{{route('posts.restore', $post->id)}}"><x-button>Restore</x-button></a>
        @else
          Not Authorized
        @endcan
      </td>
      <td>
        @can('forceDelete', $post)
          
        <form action="{{route('posts.permanent', $post->id)}}" method="POST">
          @csrf
          @method('delete')
        <input type="submit" class="btn btn-danger" value='Delete' onclick="return confirm('Are you sure?')"/>
      </form>
      @else
      Not Authorized
        @endcan
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection