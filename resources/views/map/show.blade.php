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
            @if ($tile->type == 'water')
                <div class="tile {{ $tile->type }}">@svg('wave', 'tile-svg')</div>
            @elseif ($tile->type == 'settlement')
                <a href="{{ route('travel_to', $tile->settlement) }}">
                    <div class="tile {{ $tile->type }}">@svg('villa', 'tile-svg')</div>
                </a>
            @elseif ($tile->type == 'ship')
                <a href="/ships/{{ $tile->ship }}">
                    <div class="tile {{ $tile->type }}">@svg('ship', 'tile-svg')</div>
                </a>
            @elseif ($tile->type == 'goods')
                <a href="{{ route('find_goods', $tile->id) }}">
                <div class="tile {{ $tile->type }}">@svg('crate', 'tile-svg')</div>
            @elseif ($tile->type == 'island')
                <div class="tile {{ $tile->type }}">@svg('palm-island', 'tile-svg')</div>
            @endif
        @endforeach
    @endif
@endsection