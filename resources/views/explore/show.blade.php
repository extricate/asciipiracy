@extends('explore.index')

@section('exploration')
    @if ($event)
        <h1>{{ $event->title }}</h1>
        <p>{{ $event->body }}</p>
        <span class="label @if ($event->type == "+") label-success @elseif ($event->type == "-") label-danger @else @endif">{{ $event->effect_changed }}</span>
    @endif
@endsection