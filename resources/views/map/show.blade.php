@extends('map.index')

@section('map')
    @if ($user->onMap() == null)
        <p>No map</p>

    @else
        @php
            $map = $user->onMap();
        @endphp
        @foreach($map->tiles() as $tile)
            Hello
        @endforeach
    @endif
@endsection