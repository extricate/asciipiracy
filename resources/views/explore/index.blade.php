@extends('layouts.app')

@section('title', 'Upgrade ship')

@php
    $user = auth()->user();
    $active = $user->activeShip();
@endphp

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Exploration <i class="fa fa-address-book"></i>
                    </div>
                    <div class="panel-body text-center">
                        <h1>{{ $event->title }}</h1>
                        <p>{{ $event->body }}</p>
                        @if ($event->effect_on == 'gold')
                            <span class="label label-success">{{ $event->effect_changed }}</span>
                        @elseif ($event->effect_on == 'goods')
                            <span class="label label-success">{{ $event->effect_changed }}</span>
                        @else
                        @endif

                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Actions
                    </div>
                    <div class="panel-body">
                        <a href="{{ route('explore_now') }}" class="btn btn-primary">Go explore</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection