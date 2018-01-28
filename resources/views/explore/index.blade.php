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
                    <div class="panel-footer text-center">
                        <div class="label label-info">
                            Exploration with your current ship costs {{ $ship->explorationCost() }} goods.
                        </div>
                        <br>
                        <div class="label label-info">
                            That's @php echo round($user->goods/$ship->explorationCost(), 0) @endphp more journeys with
                            the goods left.
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Active ship <a href="{{ $ship->path() }}">The {{ $ship->name }}</a>
                    </div>
                    <div class="panel-body">
                        This ship is ready to explore the seas!
                    </div>
                    <div class="panel-footer text-center">
                        @include('ships.stats')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection