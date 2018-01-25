@extends('explore.index')

@section('exploration')
    @if ($event->effect_on == 'gold')
        <h1>{{ $event->title }}</h1>
        <p>{{ $event->body }}</p>
        <span class="label label-success">{{ $event->effect_changed }}</span>
    @elseif ($event->effect_on == 'goods')
        <h1>{{ $event->title }}</h1>
        <p>{{ $event->body }}</p>
        <span class="label label-success">{{ $event->effect_changed }}</span>
    @else
    @endif
@endsection