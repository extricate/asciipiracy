@extends('explore.index')

@section('exploration')
    @if ($event)
        @if (!empty($event->icon))
            <p class="fa-5x">
                @if ($event->icon_type == 'svg')
                    {{ svg_image($event->icon)->class('icon-xxl') }}
                @else
                <i class="{{ $event->icon_type }} {{ $event->icon_type }}-{{ $event->icon }}"></i>
                @endif
            </p>
        @endif
        <h1>{{ $event->title }}</h1>
        <p>{{ $event->body }}</p>
        <span class="label @if ($event->type == "+") label-success @elseif ($event->type == "-") label-danger @else @endif">{{ $event->effect_changed }}</span>
    @endif
@endsection