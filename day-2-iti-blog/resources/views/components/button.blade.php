@props(['type' => 'primary', 'route', 'id' => null])

<a href="{{route($route, $id)}}" type="button" class="btn btn-{{$type}}">{{$slot}}</a>
