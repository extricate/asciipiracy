@extends('explore.index')

@section('exploration')
    <h1>{{ $event->title }}</h1>
    <p>{{ $event->body }}</p>
    <p>{{ $event->effect }}</p>
@endsection