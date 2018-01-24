@extends('explore.index')

@section('exploration')
    {{ $event->title }}
    {{ $event->body }}
    {{ $event->effect }}
@endsection