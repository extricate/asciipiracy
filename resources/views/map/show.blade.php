@extends('map.index')

@section('map')
    @if ($user->onMap() == null)
        <p>You currently have no map. Perhaps you would like to travel to a new region instead?</p>

    @else
        @php
            $map = $user->onMap();
            $tiles = $map->tiles($map);
        @endphp
        <div class="map-body">
            <div class="map-inner">
                @foreach($tiles as $tile)
                    @if ($tile->type == 'water')
                        <div class="tile {{ $tile->type }}">@svg('wave', 'tile-svg')</div>
                    @elseif ($tile->type == 'settlement')
                        <a href="{{ route('travel_to', $tile->id) }}">
                            <div class="tile {{ $tile->type }}-tile">@svg('villa', 'tile-svg')</div>
                        </a>
                    @elseif ($tile->type == 'ship')
                        <a href="{{ route('greet_ship', $tile->id) }}">
                            <div class="tile {{ $tile->type }}">@svg('ship', 'tile-svg')</div>
                        </a>
                    @elseif ($tile->type == 'goods')
                        <a href="{{ route('find_goods', $tile->id) }}">
                            <div class="tile {{ $tile->type }}">@svg('crate', 'tile-svg')</div>
                        </a>
                    @elseif ($tile->type == 'island')
                        <div class="tile {{ $tile->type }}">@svg('palm-island', 'tile-svg')</div>
                    @elseif ($tile->type == 'treasure')
                        <a href="{{ route('find_goods', $tile->id) }}">
                            <div class="tile {{ $tile->type }}">@svg('chest', 'tile-svg')</div>
                        </a>
                    @endif
                @endforeach
            </div>
        </div>

    @endif
@endsection