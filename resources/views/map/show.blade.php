@extends('map.index')

@section('map')
    @if ($user->onMap() == null)
        <p>No map</p>

    @else
        @php
            $map = $user->onMap();
            $tiles = $map->tiles($map);
        @endphp
        @foreach($tiles as $tile)
            <div class="tile {{ $tile->type }}">

            </div>

        @endforeach
    @endif
@endsection