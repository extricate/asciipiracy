@extends('layouts.app')

@section('title', 'Upgrade ship')

@php
    $user = auth()->user();
    $ship = auth()->user()->activeShip();
@endphp

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="ra ra-ocean-emblem"></i> Exploration
                    </div>
                    <div class="panel-body text-center">
                        @yield('exploration')
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Actions
                    </div>
                    <div class="panel-body text-center">
                        <p>
                            <a href="{{ route('explore_now') }}" class="btn btn-primary btn-lg">Go explore</a>
                        </p>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Active ship
                    </div>
                    <div class="panel-body">
                        <a href="{{ $ship->path() }}">{{ $ship->name }}</a>
                        <span class="label label-{{ $ship->health($ship) }}"><i class="fa fa-heart"></i> {{ $ship->current_health }}
                            /{{ $ship->maximum_health }}
                        </span>
                        <span class="label label-info"><i class="ra ra-crossed-sabres"></i> {{ $ship->attackStatistics($ship) }}</span><span class="label label-primary">{{ $ship->escapeStatistics($ship) }}</span><span class="label label-default"><i class="fa fa-users"></i> {{ $ship->crew->count() }}/{{ $ship->max_sailors }}</span>
                    </div>
                    <div class="panel-footer text-center">
                        <div class="label label-info">
                            Exploration with this ship costs {{ $ship->explorationCost() }} goods
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection